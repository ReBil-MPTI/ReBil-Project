<?php

namespace App\Livewire\Transaction;

use App\Models\Car;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithFileUploads;

class IndexCar extends Component
{
    use WithFileUploads;

    public $modal = false;
    public $step = 1;

    public $carId;
    public $selectedCar;

    public $userId;
    public $userName;
    public $userEmail;

    public $address;
    public $duration;
    public $status = 'pending';
    public $paymentImage;
    public $loginAlert = false;
    public $totalPayment;
    public $virtualAccount = '1234567890123456';
    public $processing = false;
    public $success = false;

    public $latestTransaction;

    // ⬅️ Tangkap event dari JavaScript
    protected $listeners = ['finishProcessing' => 'finishProcessing'];

    public function render()
    {
        $cars = Car::with('carType')->paginate(10);
        return view('livewire.transaction.index-car', [
            'cars' => $cars,
            'selectedCar' => $this->selectedCar,
        ])->extends('pages.second-header')->section('content');
    }

    public function openModal($id)
    {
        $this->carId = $id;
        $this->selectedCar = Car::find($id);

        $this->userId = auth()->id();
        $this->userName = auth()->user()->name ?? '';
        $this->userEmail = auth()->user()->email ?? '';

        $this->modal = true;
        $this->step = 1;
    }

    public function updatedDuration()
    {
        if ($this->selectedCar && $this->duration) {
            $this->totalPayment = $this->selectedCar->price * $this->duration;
        }
    }

    public function openLoginAlert()
    {
        $this->loginAlert = true;
    }

    public function nextStep()
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
        ]);

        $this->step = 2;
    }

    public function backStep()
    {
        $this->step = 1;
    }

    public function store()
    {
        $this->validate([
            'paymentImage' => 'required|image|max:2048',
        ]);

        $this->processing = true;

        $this->dispatch('start-processing');
    }

    public function finishProcessing()
    {
        try {
            $transaction = new Transaction();
            $transaction->car_id = $this->carId;
            $transaction->user_id = $this->userId;
            $transaction->address = $this->address;
            $transaction->duration = $this->duration;
            $transaction->status = $this->status;
            $transaction->noref = 'TRX-' . strtoupper(md5(now()->timestamp . '-' . $this->userId . '-' . $this->carId));
            $transaction->total_payment = $this->duration * $this->selectedCar->price;

            if ($this->paymentImage) {
                $transaction->payment_image = $this->paymentImage->store('payments', 'public');
            }

            $transaction->save();

            $this->latestTransaction = Transaction::with('car', 'user')
                ->where('user_id', $this->userId)
                ->latest()
                ->first();
            $this->success = true;
            $this->processing = false;

            $this->reset([
                'step',
                'carId',
                'selectedCar',
                'address',
                'duration',
                'paymentImage'
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function resetAfterSuccess()
    {
        $this->success = false;
        $this->modal = false;
    }

    public function resetForm()
    {
        $this->reset([
            'modal',
            'step',
            'carId',
            'selectedCar',
            'address',
            'duration',
            'paymentImage',
            'totalPayment',
        ]);
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->modal = false;
    }
}
