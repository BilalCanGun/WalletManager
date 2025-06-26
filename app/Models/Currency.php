<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',      // USD, EUR, vs.
        'name',      // Dolar, Euro gibi
        'usd_rate',  // TL karşılığı
    ];
}
