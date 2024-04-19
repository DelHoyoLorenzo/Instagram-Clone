<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = []; //stop protection
    
    public function profileImage()
    {
        $imagePath = ($this->image) ?   $this->image : '/profile/ewlzIIvKnqTYhbXp31ipzqoApPG6u3gSUE3ulOXO.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers() //many to many
    {
        return $this->belongsToMany(User::class);
    }

    
}
