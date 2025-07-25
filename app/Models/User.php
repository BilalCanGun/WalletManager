<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;

    protected $primaryKey = 'userid';
    protected $fillable = [
        'namesurname',
        'email',
        'password',
        'borntime',
        'telno',
        'job',
        'saving'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function mywallet()
    {
        return $this->hasMany(MyWallet::class, 'userid', 'userid');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class, 'userid', 'userid');
    }
}
