<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryAdmin extends Component
{
    use WithPagination;

    public $selectedTransaction;
    public $modalVisible = false;

    public function render()
    {
        $transactions = Transaction::with(['car', 'user'])->paginate(10);

        return view('livewire.transaction.history-admin', [
            'transactions' => $transactions
        ])->layout('layouts.app');
    }

    public function showDetail($id)
    {
        $this->selectedTransaction = Transaction::with(['car', 'user'])->find($id);
        $this->modalVisible = true;
    }

    public function approveSelected()
    {
        if ($this->selectedTransaction && $this->selectedTransaction->status === 'pending') {
            $this->selectedTransaction->status = 'approved';
            $this->selectedTransaction->save();

            session()->flash('success', 'Transaksi berhasil disetujui.');
            $this->modalVisible = false;
        }
    }

    public function rejectSelected()
    {
        if ($this->selectedTransaction && $this->selectedTransaction->status === 'pending') {
            $this->selectedTransaction->status = 'rejected';
            $this->selectedTransaction->save();

            session()->flash('success', 'Transaksi ditolak.');
            $this->modalVisible = false;
        }
    }
}
