<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert(
            [
            'name' => 'heinhtet@gmail.com',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('starfall'),
            ]
        );
    }
}
