<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionPrintController extends Controller
{
    public function print($id)
    {
        $transaction = Transaction::with('car', 'user')
            ->findOrFail($id);
        return view('livewire.transaction.print', get_defined_vars());
    }
}
