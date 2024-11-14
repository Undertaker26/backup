<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

public function user()
{
    return $this->belongsTo(User::class);
}

public function articles()
{
    return $this->hasMany(Article::class);
}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', // Ensure 'name' is included here
        'student_id',
        'course',
        'status',
        'email',
        'password',
        'province',   // Added field
        'city',       // Added field
        'barangay',   
        'bday',   // Added field
        'pin'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
