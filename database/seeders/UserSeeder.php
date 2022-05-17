<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name'    => 'User',
            'last_name'     => 'Example',
            'email'         => 'user@example.com',
            'phone'         => '000000000000',
            'birth_date'    => '2000-01-01',
            'gender'        => 1,
            'role'          => 1,
            'password'      => Hash::make('password'),
        ]);
    }
}
