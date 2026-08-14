<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction; // 1. Added Transaction model import
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('flash_message', 'Your cart is empty.');
        }

        $productsIds = array_keys($cart);
        $products = Product::whereIn('id', $productsIds)->get();

        $items = [];
        $totalAmount = 0;

        foreach ($products as $product) {
            $qty = (int) ($cart[$product->id] ?? 0);
            if ($qty <= 0) continue;

            $linetotal = $product->price * $qty;
            $totalAmount += $linetotal;

            $items[] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $qty,
                'linetotal'  => $linetotal,
            ];
        }

        if (empty($items)) {
            return redirect()->route('cart.index')->with('flash_message', 'Your cart is empty.');
        }

        $user = Auth::user();

        return view('checkout.index', compact('items', 'totalAmount', 'user'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'receiver_name'    => 'required|string|max:255',
            'receiver_email'   => 'required|email|max:255',
            'shipping_address' => 'required|string',
            'phone_number'     => 'required|string|max:20',
            'payment_method'   => 'required|in:cod,stripe',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('flash_message', 'Your cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();
        $items = [];
        $totalAmount = 0;

        foreach ($products as $product) {
            $qty = (int) ($cart[$product->id] ?? 0);
            if ($qty <= 0) continue;

            $linetotal = $product->price * $qty;
            $totalAmount += $linetotal;

            $items[] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'quantity'   => $qty,
                'linetotal'  => $linetotal,
            ];
        }

        // --- STRIPE ROUTE ---
        if ($validated['payment_method'] === 'stripe') {
            Stripe::setApiKey(config('services.stripe.secret'));

            $stripeLineItems = [];

            foreach ($items as $item) {
                $stripeLineItems[] = [
                    'price_data' => [
                        'currency'     => 'usd',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount'  => (int) round($item['price'] * 100),
                    ],
                    'quantity'   => $item['quantity'],
                ];
            }

            try {
                session([
                    'pending_order' => array_merge($validated, [
                        'user_id'      => Auth::id(),
                        'items'        => $items,
                        'total_amount' => $totalAmount,
                    ])
                ]);

                $checkoutSession = StripeSession::create([
                    'payment_method_types' => ['card'],
                    'line_items'           => $stripeLineItems,
                    'mode'                 => 'payment',
                    'customer_email'       => $validated['receiver_email'],
                    'success_url'          => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'           => route('checkout.index'),
                ]);

                return redirect($checkoutSession->url);
            } catch (\Exception $e) {
                return back()->withInput()->with('flash_message', 'Error creating Stripe checkout session: ' . $e->getMessage())->with('flash_message_type', 'danger');
            }
        }

        // --- COD ROUTE ---
        try {
            $orderId = $this->saveOrderToDatabase(array_merge($validated, [
                'user_id'      => Auth::id(),
                'items'        => $items,
                'total_amount' => $totalAmount,
            ]));

            session()->forget('cart');

            return redirect()->route('checkout.thankyou', ['order' => $orderId])
                ->with('flash_message', 'Order placed successfully!')
                ->with('flash_message_type', 'success');
        } catch (\Exception $e) {
            return back()->withInput()->with('flash_message', 'Error processing order: ' . $e->getMessage())->with('flash_message_type', 'danger');
        }
    }

    public function success(Request $request)
    {
        $pendingOrder = session('pending_order');
        $sessionId = $request->get('session_id');

        if (!$pendingOrder || !$sessionId) {
            return redirect()->route('home')->with('flash_message', 'No pending order or session found.')->with('flash_message_type', 'danger');
        }

        try {
            // Fetch session details from Stripe to get payment_intent ID
            Stripe::setApiKey(config('services.stripe.secret'));
            $stripeSession = StripeSession::retrieve($sessionId);

            // 2. Save order and order items
            $orderId = $this->saveOrderToDatabase($pendingOrder);

            // 3. Save Transaction record according to migration schema
            Transaction::create([
                'order_id'          => $orderId, //[cite: 17]
                'user_id'           => $pendingOrder['user_id'] ?? Auth::id(), //[cite: 17]
                'stripe_session_id' => $stripeSession->id, //[cite: 17]
                'payment_intent_id' => $stripeSession->payment_intent ?? 'N/A', //[cite: 17]
                'amount'            => $pendingOrder['total_amount'], //[cite: 17]
                'currency'          => strtoupper($stripeSession->currency ?? 'usd'), //[cite: 17]
                'payment_status'    => $stripeSession->payment_status ?? 'paid', //[cite: 17]
                'payment_method'    => 'stripe', //[cite: 17]
            ]);

            session()->forget(['cart', 'pending_order']);

            return redirect()->route('checkout.thankyou', ['order' => $orderId])
                ->with('flash_message', 'Order placed successfully!')
                ->with('flash_message_type', 'success');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('flash_message', 'Error processing order: ' . $e->getMessage())->with('flash_message_type', 'danger');
        }
    }

    public function thankyou($orderId)
    {
        $order = Order::with('items.product')->where('id', $orderId)->firstOrFail();

        return view('checkout.thankyou', compact('order'));
    }

    private function saveOrderToDatabase(array $orderData)
    {
        $order = DB::transaction(function () use ($orderData) {
            $order = Order::create([
                'user_id'          => $orderData['user_id'] ?? null,
                'receiver_name'    => $orderData['receiver_name'],
                'receiver_email'   => $orderData['receiver_email'],
                'receiver_phone'   => $orderData['phone_number'] ?? null,
                'receiver_address' => $orderData['shipping_address'],
                'total_amount'     => $orderData['total_amount'],
                'payment_method'   => $orderData['payment_method'],
            ]);

            foreach ($orderData['items'] as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unitprice'  => $item['price'],
                    'line_total' => $item['linetotal'],
                ]);
            }

            return $order;
        });

        $emailItems = array_map(function ($item) {
            return [
                'productname' => $item['name'],
                'quantity'    => $item['quantity'],
                'linetotal'   => $item['linetotal'],
            ];
        }, $orderData['items']);

        MailHelper::sendOrderConfirmationEmail(
            $orderData['receiver_email'],
            $orderData['receiver_name'],
            $order->id,
            $emailItems,
            $orderData['total_amount'],
            $orderData['shipping_address'],
            strtoupper($orderData['payment_method'])
        );

        return $order->id;
    }
}