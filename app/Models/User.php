<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AccountRecoveryQuestion;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'recovery_question_id',
        'recovery_question_answer',
        'image_name',
        'hash_image_name',
        'image_path'
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

    public function recovery_question()
    {
        return $this->hasOne(AccountRecoveryQuestion::class);
    }

    public function getProfilePictureUrl()
    {
        if ($this->image_name) {
            return asset('storage/profile_pictures/' . $this->hash_image_name);
        } else {
            return asset('storage/profile_pictures/no-profile.png');
        }
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followButtonText(){
        $isFollowing  = in_array(auth()->id(),$this->followers()->get()->pluck('id')->toArray());
        // dump($text);
        return ($isFollowing ) ? 'Following' : 'Follow';
    }
}
