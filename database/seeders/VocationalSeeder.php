<?php

namespace Database\Seeders;

use App\Models\Vocational;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VocationalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vocational::create(
            [
                'name' => 'Contoh Jurusan',
                'hov_id' => 3,
            ]
        );
    }
}
