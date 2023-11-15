<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\StudentProfileSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TeacherProfileSeeder::class);
        $this->call(VocationalSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(StudentProfileSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
