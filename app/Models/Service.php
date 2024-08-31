<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'TGL_DEC',
        'MODEL',
        'NO_RANGKA',
        'CUSTOMER',
        'NOPOL',
        'NOTE',
    ];
}
