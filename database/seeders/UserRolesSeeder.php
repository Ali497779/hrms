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
            'customer' => 'is_customer',
            'sales' => 'is_sales',
            'projectmanager' => 'is_projectmanager',
            'developer' => 'is_developer',
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
