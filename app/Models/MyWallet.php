<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyWallet extends Model
{
    use HasFactory;
    protected $primaryKey = 'walletid';

    protected $table = 'mywallet';
    protected $fillable = [
        'userid',
        'type',
        'value',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}