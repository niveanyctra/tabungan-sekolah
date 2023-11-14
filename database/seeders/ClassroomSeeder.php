<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classroom::create(
            [
                'vocational_id' => 1,
                'name' => 'Contoh Kelas',
                'ht_id' => 4,
            ]
        );
    }
}
