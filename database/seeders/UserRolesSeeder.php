<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Array of roles and their respective boolean column
        $roles = [
            'admin' => 'is_admin',
            
        ];

        foreach ($roles as $role => $column) {
            User::factory()->create([
                'name' => ucfirst($role),
                'email' => "{$role}@straxum.com",
                'password' => bcrypt('123456789'),
                $column => true,
            ]);
        }
    }
}
