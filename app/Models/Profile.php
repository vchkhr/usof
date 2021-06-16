<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'real_name', 'description', 'url', 'profile_photo'];

    public function profileImage()
    {
        if ($this->profile_photo == null) {
            return 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/480px-Circle-icons-profile.svg.png';
        }

        $id = $this->profile_photo;

        return Image::find($id)->url;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
