<?php

namespace App\Livewire\CarCrud;

use Livewire\Component;
use App\Models\Car;
use App\Models\CarType;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Cars extends Component
{
    use WithPagination, WithFileUploads;
    public $carName;
    public $carTypeId;
    public $policeNumber;
    public $carYear;
    public $carImage;
    public $carId = null;
    public $confirmingDelete = false;
    public $deleteId = null;

    public $modalVisibleForm = false;
    public $modalEdit = false;

    protected $rules = [
        'carName' => 'required|string',
        'carTypeId' => 'required|exists:car_types,id',
        'policeNumber' => 'required|string|unique:cars,police_number',
        'carImage' => 'required|image|max:2048',
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
        'carImage.required' => 'Gambar mobil wajib diunggah!',
        'carImage.image' => 'File yang diunggah harus berupa gambar!',
        'carImage.max' => 'Ukuran gambar tidak boleh lebih dari 2MB!',
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
            if ($this->carImage) {
                $imagePath = $this->carImage->store('cars', 'public');
                $this->carImage = $imagePath;
            }
            Car::create([
                'car_name' => $this->carName,
                'car_type_id' => $this->carTypeId,
                'car_image' => $this->carImage,
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

    public function edit($id)
    {
        $car = Car::findOrFail($id);

        $this->carId = $car->id;
        $this->carName = $car->car_name;
        $this->carTypeId = $car->car_type_id;
        $this->policeNumber = $car->police_number;
        $this->carYear = $car->year;
        $this->carImage = null; // reset karena kita tidak mengisi file input

        $this->modalEdit = true;
        $this->modalVisibleForm = true;
    }

    public function update()
    {
        $this->validate([
            'carName' => 'required|string',
            'carTypeId' => 'required|exists:car_types,id',
            'policeNumber' => 'required|string|unique:cars,police_number,' . $this->carId,
            'carYear' => 'required|integer|min:1900',
            'carImage' => 'nullable|image|max:2048',
        ]);

        try {
            $car = Car::findOrFail($this->carId);

            if ($this->carImage) {
                $imagePath = $this->carImage->store('cars', 'public');
                $car->car_image = $imagePath;
            }

            $car->update([
                'car_name' => $this->carName,
                'car_type_id' => $this->carTypeId,
                'police_number' => $this->policeNumber,
                'year' => $this->carYear,
            ]);

            session()->flash('success', 'Data mobil berhasil diperbarui.');
            $this->resetForm();
            $this->modalVisibleForm = false;
            $this->modalEdit = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }


    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteMobil()
    {
        try {
            Car::findOrFail($this->deleteId)->delete();
            session()->flash('success', 'Mobil berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus data: ' . $e->getMessage());
        }

        $this->confirmingDelete = false;
        $this->deleteId = null;
    }


    public function resetForm()
    {
        $this->reset(['carId', 'carName', 'carTypeId', 'policeNumber', 'carYear', 'carImage']);
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
