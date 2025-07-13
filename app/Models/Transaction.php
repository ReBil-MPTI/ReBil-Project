<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public static function getDuration()
    {
        return [
            '1' => '1 Hari',
            '2' => '2 Hari',
            '3' => '3 Hari',
            '4' => '4 Hari',
            '5' => '5 Hari',
            '6' => '6 Hari',
            '7' => '7 Hari',
        ];
    }

    public static function getDurationAtribute()
    {
        return self::getDuration();
    }
}
