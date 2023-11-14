<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    public function vocational()
    {
        return $this->hasOne(Vocational::class, 'hov_id', 'id');
    }
    public function classroom()
    {
        return $this->hasOne(Classroom::class, 'ht_id', 'id');
    }
}
