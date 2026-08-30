<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'client_name', 'description', 'image_path', 'video_url', 'video_type', 'event_year'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
