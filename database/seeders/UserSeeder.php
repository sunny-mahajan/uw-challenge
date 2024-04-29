<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Add users using DB facade
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('12345678'),
        ]);

        // Add users using Eloquent model
        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alice@example.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Bob Anderson',
            'email' => 'bob@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
