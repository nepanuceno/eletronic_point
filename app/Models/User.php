<?php

namespace App\Models;

use App\Models\UserProfileImage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function adminlte_image()
    {
        $folderPath = '/storage/images/profiles_users_images/';
        if($this->getProfilePicture) {
            return $folderPath.$this->getProfilePicture->name;
        } else {
            return '/images/avatar.png';
        }
    }

    public function adminlte_desc()
    {
        return $this->getRoleNames();
    }

    public function adminlte_profile_url()
    {
        return 'users/'.$this->id;
    }

    public function getProfilePicture()
    {
        try {
            return $this->hasOne(UserProfileImage::class, 'user_id');
        } catch (\Throwable $th) {
            return false;
        }
    }
}
