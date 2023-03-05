<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];


    #region relation
    public function Posts()
    {
        return $this->hasMany(Post::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Videos()
    {
        return $this->hasMany(Video::class);
    }
    #endregion

    #region attributes
    public function getAccesstokenAttribute()
    {
        return $this->createToken("auth_token")->plainTextToken;
    }

    public function scopeWhereUsername($query, $username)
    {
        return $query->where('username','=', $username);
    }

    #endregion
}
