<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_pic_url',
        'is_teacher'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gradebook()
    {
        return $this->hasOne(Gradebook::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
        ];
    }

    // public function updateIsTeacherToTrue($user_id)
    // {
    //     User::where('id', $user_id)->update(['is_teacher' => 1]);
    // }

    public function scopeSearchByName($query, $name) {
        if (!$name) {
            return $query;
        } 
        

        return $query->where('first_name', 'like', "{$name}%")->orWhere('last_name', 'like', "{$name}%");
    }
}
