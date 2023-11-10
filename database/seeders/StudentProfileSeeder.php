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
                'id' => 4,
                // 'username' => 'student',
                'classroom_id' => 1,
                'jumlah' =>  50000,
            ]
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
