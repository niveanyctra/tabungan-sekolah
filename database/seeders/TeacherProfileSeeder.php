<?php

namespace Database\Seeders;

use App\Models\TeacherProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherProfiles = [
            [
                'id' => 3,
            ],
        ];
        foreach ($teacherProfiles as $data){
            TeacherProfile::insert([
                'id' => $data['id'],
            ]);
        }
    }
}
