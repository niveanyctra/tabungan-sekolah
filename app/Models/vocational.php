<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocational extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'vocational_id', 'id');
    }
}
