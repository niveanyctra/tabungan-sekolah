<?php

namespace App\Models;

use App\Models\transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function transaction()
    {
        return $this->hasMany(transaction::class,'user_id','id');
    }
}
