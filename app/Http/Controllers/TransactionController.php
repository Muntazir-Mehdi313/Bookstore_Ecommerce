<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of all transactions.
     */
    public function index()
    {
        // Fetch transactions with eager loaded order & user relationships
        $transactions = Transaction::with(['order', 'user'])
            ->latest()
            ->paginate(15);

        // Return view at resources/views/transactions/index.blade.php
        return view('transactions.index', compact('transactions'));
    }
}