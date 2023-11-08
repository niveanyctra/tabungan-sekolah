<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Teacher']);
        Role::create(['name' => 'Student']);
    }
}
