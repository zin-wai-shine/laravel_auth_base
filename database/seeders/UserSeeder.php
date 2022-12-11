<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'role' => '0',
           'password' => Hash::make('asdffdsa')
        ]);

        User::create([
            'name' => 'editor',
            'email' => 'editor@gmail.com',
            'role' => '1',
            'password' => Hash::make('asdffdsa')
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => '2',
            'password' => Hash::make('asdffdsa')
        ]);
    }
}
