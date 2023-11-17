<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $table = 'student_profiles';

    protected $fillable = [
        'classroom_id',
        'jumlah'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id')->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id')->withDefault();
    }
}
