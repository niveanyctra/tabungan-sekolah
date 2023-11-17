<?php

namespace App\Models;

use App\Models\StudentProfile;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_hint',
        'status',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function student()
    {
        return $this->hasOne(StudentProfile::class, 'id', 'id');
    }
    public function teacher()
    {
        return $this->hasOne(TeacherProfile::class, 'id', 'id');
    }
    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class, 'id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            // Delete the associated student when the user is deleted
            $user->student()->delete();
        });
    }
}
