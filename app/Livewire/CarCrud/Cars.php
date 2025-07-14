<?php

namespace App\Livewire\CarCrud;

use App\Models\Car;
use App\Models\User;
use App\Models\CarType;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Cars extends Component
{
    use WithPagination, WithFileUploads;

    public $carName;
    public $carTypeId;
    public $policeNumber;
    public $carYear;
    public $carImage;
    public $transmissionType;
    public $engineCapacity;
    public $fuelType;
    public $transmissionConcept;
    public $price;
    public $seatCapacity;
    public $carId = null;
    public $confirmingDelete = false;
    public $deleteId = null;
    public $searchName = '';
    public $availableYears = [];
    public $filterYear = '';
    public $modalVisibleForm = false;
    public $modalEdit = false;

    protected $queryString = [
        'searchName' => ['except' => '', 'as' => 'search'],
        'filterYear' => ['except' => '']
    ];

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

    public function mount()
    {
        $this->loadAvailableYears();
    }

    public function loadAvailableYears()
    {
        $this->availableYears = Car::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        $currentYear = date('Y');
        if (!in_array($currentYear, $this->availableYears)) {
            array_unshift($this->availableYears, $currentYear);
        }
    }

    public function render()
    {
        $query = Car::with('carType');

        if (!empty($this->searchName)) {
            $query->where('car_name', 'like', '%' . $this->searchName . '%');
        }

        if (!empty($this->filterYear)) {
            $query->where('year', $this->filterYear);
        }

        $cars = $query->latest()->paginate(10);

        return view('livewire.car-crud.cars', [
            'carTypes' => CarType::all(),
            'cars' => $cars,
        ])->layout('layouts.app');
    }

    //ini buat consumen
    public function index()
    {
        $cars = Car::with('carType')->paginate(10);
        $user = User::all();
        return view('transaction.car', get_defined_vars());
    }

    public function updatedSearchName()
    {
        $this->resetPage();
    }

    public function updatedFilterYear()
    {
        $this->resetPage();
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
            $imagePath = null;
            if ($this->carImage) {
                $imagePath = Storage::disk('public')->put('cars', $this->carImage);
            }

            Car::create([
                'car_name' => $this->carName,
                'car_type_id' => $this->carTypeId,
                'car_image' => $imagePath,
                'police_number' => $this->policeNumber,
                'year' => $this->carYear,
                'transmission_type' => $this->transmissionType,
                'engine_capacity' => $this->engineCapacity,
                'fuel_type' => $this->fuelType,
                'transmission_type_concept' => $this->transmissionConcept,
                'price' => $this->price,
                'seat_capacity' => $this->seatCapacity,
            ]);

            session()->flash('success', 'Mobil berhasil ditambahkan.');
            $this->resetForm();
            $this->modalVisibleForm = false;

            $this->loadAvailableYears();
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
        $this->carImage = $car->car_image;
        $this->transmissionType = $car->getRawOriginal('transmission_type');
        $this->fuelType = $car->getRawOriginal('fuel_type');
        $this->transmissionConcept = $car->getRawOriginal('transmission_type_concept');
        $this->seatCapacity = $car->getRawOriginal('seat_capacity');
        $this->engineCapacity = $car->engine_capacity;
        $this->price = $car->price;
        $this->modalEdit = true;
        $this->modalVisibleForm = true;
    }

    public function update()
    {
        $rules = [
            'carName' => 'required|string',
            'carTypeId' => 'required|exists:car_types,id',
            'policeNumber' => 'required|string|unique:cars,police_number,' . $this->carId,
            'carYear' => 'required|integer|min:1900',
        ];

        if ($this->carImage && !is_string($this->carImage)) {
            $rules['carImage'] = 'image|max:2048';
        }

        $this->validate($rules);

        try {
            $car = Car::findOrFail($this->carId);

            // Jika gambar baru diunggah
            if ($this->carImage && !is_string($this->carImage)) {
                $imagePath = Storage::disk('public')->put('cars', $this->carImage);
                $car->car_image = $imagePath;
            }

            $car->car_name = $this->carName;
            $car->car_type_id = $this->carTypeId;
            $car->police_number = $this->policeNumber;
            $car->year = $this->carYear;
            $car->transmission_type = $this->transmissionType;
            $car->fuel_type = $this->fuelType;
            $car->transmission_type_concept = $this->transmissionConcept;
            $car->seat_capacity = $this->seatCapacity;
            $car->engine_capacity = $this->engineCapacity;
            $car->price = $this->price;
            $car->save();

            session()->flash('success', 'Data mobil berhasil diperbarui.');
            $this->resetForm();
            $this->modalVisibleForm = false;
            $this->modalEdit = false;

            $this->loadAvailableYears();
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

            $this->loadAvailableYears();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus data: ' . $e->getMessage());
        }

        $this->confirmingDelete = false;
        $this->deleteId = null;
    }

    public function resetForm()
    {
        $this->reset([
            'carId',
            'carName',
            'carTypeId',
            'policeNumber',
            'carYear',
            'transmissionType',
            'fuelType',
            'transmissionConcept',
            'seatCapacity',
            'engineCapacity',
            'price'
        ]);

        if (!$this->modalEdit) {
            $this->carImage = null;
        }

        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function clearFilters()
    {
        $this->searchName = '';
        $this->filterYear = '';
        $this->resetPage();
    }
}
