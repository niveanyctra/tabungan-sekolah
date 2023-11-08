<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Super Admin',
                // 'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'role_id' =>  1,
            ],
            [
                'name' => 'Administrator',
                // 'username' => 'administrator',
                'email' => 'administrator@example.com',
                'role_id' =>  2,
            ],
            [
                'name' => 'Teacher',
                // 'username' => 'teacher',
                'email' => 'teacher@example.com',
                'role_id' =>  3,
            ],
            [
                'name' => 'Students',
                // 'username' => 'student',
                'email' => 'student@example.com',
                'role_id' =>  4,
            ]
        ];

        foreach ($user as $data){
            User::insert([
                'name' => $data['name'],
                // 'username' => $data['username'],
                'email' => $data['email'],
                'email_verified_at' => Carbon::now()->format('Y-m-d'),
                'password' => Hash::make('password'),
                'password_hint' => 'password',
                'role_id' => $data['role_id'],
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ]);
        }
    }
}