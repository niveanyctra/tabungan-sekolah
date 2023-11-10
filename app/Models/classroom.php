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
    ];

    public function vocational()
    {
        return $this->belongsTo(Vocational::class, 'vocational_id', 'id');
    }
}
