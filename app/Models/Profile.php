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
            return 'https://openmoji.org/data/color/svg/1F9D1.svg';
        }

        $id = $this->profile_photo;

        return Image::find($id)->url;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
