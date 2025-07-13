<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function getTransmissionTypes()
    {
        return [
            '01' => 'Manual',
            '02' => 'Automatic',
            '03' => 'Semi-Automatic',
        ];
    }

    public function getTransmissionTypeAttribute()
    {
        return self::getTransmissionTypes()[$this->attributes['transmission_type']] ?? 'Unknown';
    }

    public static function getFuelType()
    {
        return [
            '01' => 'Bensin',
            '02' => 'Solar'
        ];
    }

    public function getFuelTypeAttribute()
    {
        return self::getFuelType()[$this->attributes['fuel_type']] ?? 'Unknown';
    }

    public static function getTransmissionTypeConcept()
    {
        return [
            '01' => 'Front Wheel Drive',
            '02' => 'Rear Wheel Drive',
            '03' => 'All Wheel Drive',
            '04' => 'Four Wheel Drive',
        ];
    }

    public function getTransmissionTypeConceptAttribute()
    {
        return self::getTransmissionTypeConcept()[$this->attributes['transmission_type_concept']] ?? 'Unknown';
    }

    public static function getSeatCapacity()
    {
        return [
            '01' => '2 kursi',
            '02' => '4 kursi',
            '03' => '5 kursi',
            '04' => '7 kursi',
            '05' => '8 kursi',
        ];
    }

    public function getSeatCapacityAttribute()
    {
        return self::getSeatCapacity()[$this->attributes['seat_capacity']] ?? 'Unknown';
    }
}
