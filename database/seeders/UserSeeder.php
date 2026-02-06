<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           User::create([
            'name' => 'Geinf Admin',
            'email' => 'admin@geinf.com',
            'password' => Hash::make('admin1234'),
            'role_id' => Role::where('name', 'Administrator')->first()->id
           ]);
    }
}
