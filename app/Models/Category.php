<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'image_path', 'description', 'history'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
