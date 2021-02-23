<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PageController extends Controller
{

    public function invoice(Transaction $transaction)
    {
        return view('invoices.invoice', [
            'transaction' => $transaction,
        ]);
    }
    public function report(Request $request)
    {
        $transactions = Transaction::with('products')->where('is_final', true)->whereBetween('updated_at', [Carbon::parse($request->date_from), Carbon::parse($request->date_to)->addDay()])->get();
        return view('livewire.reports.print-report', ['transactions' => $transactions]);
    }
}