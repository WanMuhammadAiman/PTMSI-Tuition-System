<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create or update user
        $user = User::updateOrCreate(
            ['email' => 'admin@ptmsi.com'],
            [
                'name' => 'Admin PTMSI',
                'password' => Hash::make('admin123'),
            ]
        );

        // Assign actual Spatie role
        $user->assignRole($adminRole);
    
    }
}
