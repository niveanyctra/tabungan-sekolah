<?php

namespace Database\Seeders;

use App\Models\StudentProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $studentProfile = [
            [
                'id' => 5,
                // 'username' => 'student',
                'classroom_id' => 1,
                'jumlah' =>  50000,
            ],
            [
                'id' => 6,
                // 'username' => 'student',
                'classroom_id' => 1,
                'jumlah' =>  50000,
            ],
            [
                'id' => 7,
                // 'username' => 'student',
                'classroom_id' => 1,
                'jumlah' =>  20000,
            ],
        ];
        foreach ($studentProfile as $data){
            StudentProfile::insert([
                'id' => $data['id'],
                // 'username' => $data['username'],
                'classroom_id' => $data['classroom_id'],
                'jumlah' => $data['jumlah'],
            ]);
        }
    }
}
