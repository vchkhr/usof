<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['real_name', 'description', 'url', 'profile_photo'];

    public function profileImage()
    {
        if ($this->profile_photo == null) {
            return '/storage/profile/profile.jpg';
        }

        return '/storage/' . $this->profile_photo;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
