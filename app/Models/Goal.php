<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $primaryKey = 'goalid';
    protected $table = 'goals';


    protected $fillable = [

        'userid',
        'goal_name',
        'cost',
        'image'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}
