<?php

namespace App\Livewire\CarCrud;

use Livewire\Component;
use App\Models\Car;
use App\Models\CarType;
use Livewire\WithPagination;

class Cars extends Component
{
    use WithPagination;
    public $carName;
    public $carTypeId;
    public $policeNumber;
    public $carYear;

    public $modalVisibleForm = false;

    protected $rules = [
        'carName' => 'required|string',
        'carTypeId' => 'required|exists:car_types,id',
        'policeNumber' => 'required|string|unique:cars,police_number',
        'carYear' => 'required|integer|min:1900',
    ];

    protected $messages = [
        'carName.required' => 'Nama mobil harus diisi!',
        'carTypeId.required' => 'Jenis mobil wajib dipilih!',
        'carTypeId.exists' => 'Jenis mobil tidak valid!',
        'policeNumber.required' => 'Plat nomor wajib diisi!',
        'policeNumber.unique' => 'Plat nomor sudah terdaftar!',
        'carYear.required' => 'Tahun pengeluaran wajib diisi!',
        'carYear.integer' => 'Tahun pengeluaran harus berupa angka!',
        'carYear.min' => 'Tahun pengeluaran tidak boleh kurang dari 1900!',
    ];

    public function render()
    {
        return view('livewire.car-crud.cars', [
            'carTypes' => CarType::all(),
            'cars' => Car::with('carType')->latest()->paginate(10),
        ])->layout('layouts.app');
    }

    public function showModalForm()
    {
        $this->resetForm();
        $this->modalVisibleForm = true;
    }

    public function store()
    {
        $this->validate();

        try {
            Car::create([
                'car_name' => $this->carName,
                'car_type_id' => $this->carTypeId,
                'police_number' => $this->policeNumber,
                'year' => $this->carYear,
            ]);

            session()->flash('success', 'Mobil berhasil ditambahkan.');
            $this->resetForm();
            $this->modalVisibleForm = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['carName', 'carTypeId', 'policeNumber', 'carYear']);
    }
}
