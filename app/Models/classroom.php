<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'vocational_id',
        'name',
        'ht_id',
    ];

    public function vocational()
    {
        return $this->belongsTo(Vocational::class, 'vocational_id', 'id');
    }
    public function studentProfiles()
    {
        return $this->hasMany(StudentProfile::class);
    }
    public function ht()
    {
        return $this->belongsTo(TeacherProfile::class, 'ht_id', 'id');
    }
}
