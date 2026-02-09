<?php

namespace Database\Seeders;

use Hash;
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

        $users = [
            ['name' => 'Alice CTO', 'email' => 'alice@geinf.com', 'role' => 'CTO'],
            ['name' => 'Bob Team Lead', 'email' => 'bob@geinf.com', 'role' => 'Team Lead'],
            ['name' => 'Charlie Senior', 'email' => 'charlie@geinf.com', 'role' => 'Senior Developer'],
            ['name' => 'Diana Mid', 'email' => 'diana@geinf.com', 'role' => 'Mid Developer'],
            ['name' => 'Ethan Junior', 'email' => 'ethan@geinf.com', 'role' => 'Junior Developer'],
            ['name' => 'Fiona Intern', 'email' => 'fiona@geinf.com', 'role' => 'Intern'],
            ['name' => 'George QA', 'email' => 'george@geinf.com', 'role' => 'QA'],
            ['name' => 'Hannah DevOps', 'email' => 'hannah@geinf.com', 'role' => 'DevOps'],
            ['name' => 'Ian Product', 'email' => 'ian@geinf.com', 'role' => 'Product Owner'],
        ];

        foreach ($users as $u) {
            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make('password123'), // senha padrão para todos
                'role_id' => Role::where('name', $u['role'])->first()->id
            ]);
        }
    }
}
