<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'userid' => 1,
            'namesurname' => 'Bilal Can Gun',
            'email' => 'bilalcangunbcg@gmail.com',
            'password' => Hash::make('123456789'),
            'borntime' => '2002-02-20',
            'telno' => '5511279401',


        ]);
        User::create([
            'userid' => 2,
            'namesurname' => 'Esmanur Saricam',
            'email' => 'esmanursaricam@gmail.com',
            'password' => Hash::make('123456789'),
            'borntime' => '1995-01-01',
            'telno' => '5551234567',

        ]);
        User::create([
            'userid' => 3,
            'namesurname' => 'Admin',
            'email' => 'admin@walletmanager.com',
            'password' => Hash::make('123456789'),
            'borntime' => '2025-06-19',
            'telno' => '5551234567',

        ]);
    }
}