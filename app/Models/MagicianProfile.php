<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicianProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'bio', 'image_path', 'tiktok_url', 'instagram_url', 'youtube_url'
    ];
}
