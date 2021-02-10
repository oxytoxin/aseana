<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function invoice(Transaction $transaction)
    {
        return view('invoices.invoice', [
            'transaction' => $transaction,
        ]);
    }
}