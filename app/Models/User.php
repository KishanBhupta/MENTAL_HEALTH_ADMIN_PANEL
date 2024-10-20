<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "firstName",
        "lastName",
        "email",
        "password",
        "phoneNumber",
        "isBlocked",
        "userName",
        "profileImage"
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
        'password' => 'hashed',
    ];

    public function getAccessToken()
    {
        $accessTokenId = $this->tokens()->first()->id;
        $accessToken = $this->findForToken($accessTokenId);

        return $accessToken;
    }

    public function isFollowed()
    {
        return Followers::where('followerId', '=', auth()->id())->where('users_id', $this->id)->where('isFollowing', true)->exists();
    }

    public function isRequested()
    {
        return Followers::where('followerId', '=', auth()->id())->where('users_id', $this->id)->where('isRequested', true)->exists();
    }
}
