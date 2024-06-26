<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomeMail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot() //events after or before a model is created
    {
        parent::boot(); 

        //after creating an user (register)
        static::created(function ($user) {
            $user->profile()->create([
                'title'=> $user->username,
                'image'=> '/profile/ewlzIIvKnqTYhbXp31ipzqoApPG6u3gSUE3ulOXO.png',
            ]);
        
        //mailtrap
            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    public function profile() //singular -> has one
    {
        return $this->hasOne(Profile::class)->orderBy('created_at', 'DESC');
    }

    public function following() //many to many
    {
        return $this->belongsToMany(Profile::class);
    }

    public function posts() //plural -> has many
    {
        return $this->hasMany(Post::class);
    }

    public function comments() //plural -> has many
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    public function visitedProfiles()
    {
        return $this->hasMany(ProfileVisit::class, 'user_id');
    }
}
