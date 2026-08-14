<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
    /**
     * Send order confirmation email via PHPMailer SMTP.
     */
    public static function sendOrderConfirmationEmail(
        string $toEmail,
        string $toName,
        int $orderId,
        array $items,
        float $totalAmount,
        string $address,
        string $paymentMethod
    ): bool {
        $mail = new PHPMailer(true);

        try {
            // SMTP CONFIG[cite: 20]
            $mail->isSMTP(); //[cite: 20]
            $mail->Host       = 'smtp.gmail.com'; //[cite: 20]
            $mail->SMTPAuth   = true; //[cite: 20]
            $mail->Username   = 'muntazirmehdi9742@gmail.com'; //[cite: 20]
            $mail->Password   = 'sbhdmloaujuamehr'; //[cite: 20]
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //[cite: 20]
            $mail->Port       = 587; //[cite: 20]

            $mail->setFrom('muntazirmehdi9742@gmail.com', 'NovelPoint'); //[cite: 20]
            $mail->addAddress($toEmail, $toName); //[cite: 20]
            $mail->addReplyTo('muntazirmehdi9742@gmail.com', 'NovelPoint Support'); //[cite: 20]

            $mail->isHTML(true); //[cite: 20]
            $mail->Subject = "Your NovelPoint Order #$orderId is confirmed"; //[cite: 20]

            $itemsHtml = '';
            foreach ($items as $it) {
                $itemsHtml .= '
                    <tr>
                        <td style="padding:10px 0; border-bottom:1px solid #e2e8f0; color:#0f172a;">'
                            . htmlspecialchars($it['productname']) . ' &times; ' . (int)$it['quantity'] . '
                        </td>
                        <td style="padding:10px 0; border-bottom:1px solid #e2e8f0; text-align:right; color:#0f172a;">
                            $' . number_format($it['linetotal'], 2) . '
                        </td>
                    </tr>'; //[cite: 20]
            }

            $mail->Body = '
            <div style="font-family: Arial, sans-serif; max-width:560px; margin:0 auto; background:#f8fafc; padding:30px;">
                <div style="background:#ffffff; border-radius:12px; padding:32px; border:1px solid #e2e8f0;">
                    <div style="text-align:center; margin-bottom:24px;">
                        <div style="width:56px; height:56px; margin:0 auto 14px; border-radius:50%;
                                    background:linear-gradient(135deg,#2563eb,#1d4ed8); color:#fff;
                                    display:inline-flex; align-items:center; justify-content:center; font-size:24px; line-height:56px;">
                            &#10003;
                        </div>
                        <h2 style="margin:0; color:#0f172a; font-size:22px;">Thank you, ' . htmlspecialchars($toName) . '!</h2>
                        <p style="color:#64748b; font-size:14px; margin-top:6px;">
                            Your order has been placed successfully.
                        </p>
                        <div style="display:inline-block; background:#f0f4f8; color:#2563eb; font-weight:700;
                                    font-size:13px; padding:6px 16px; border-radius:20px; margin-top:10px;">
                            Order #' . $orderId . '
                        </div>
                    </div>

                    <table style="width:100%; border-collapse:collapse; font-size:14px;">
                        ' . $itemsHtml . '
                        <tr>
                            <td style="padding-top:14px; font-weight:700; color:#0f172a;">Total</td>
                            <td style="padding-top:14px; font-weight:700; text-align:right; color:#0f172a;">
                                $' . number_format($totalAmount, 2) . '
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top:20px; padding-top:16px; border-top:1px solid #e2e8f0; font-size:13px; color:#64748b;">
                        <p style="margin:4px 0;"><strong>Shipping to:</strong> ' . htmlspecialchars($address) . '</p>
                        <p style="margin:4px 0;"><strong>Payment method:</strong> ' . htmlspecialchars($paymentMethod) . '</p>
                    </div>

                    <p style="text-align:center; color:#94a3b8; font-size:12px; margin-top:28px;">
                        &copy; ' . date('Y') . ' NovelPoint. All rights reserved.
                    </p>
                </div>
            </div>'; //[cite: 20]

            $mail->AltBody = "Thank you for your order #$orderId! Total: $" . number_format($totalAmount, 2); //[cite: 20]

            $mail->send(); //[cite: 20]
            return true; //[cite: 20]

        } catch (Exception $e) {
            error_log('Order confirmation email failed: ' . $mail->ErrorInfo); //[cite: 20]
            return false; //[cite: 20]
        }
    }
}