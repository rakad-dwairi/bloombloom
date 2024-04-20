<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $role = Role::create([
            'privilege' => 'admin',
            'ref_id' => 1001, // Or any other unique identifier for admin role
            'user_id' => $user->id,
        ]);
    }
}
