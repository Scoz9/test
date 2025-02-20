<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = ['album_name', 'description', 'user_id', 'album_thumb'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function categories()
    {
        // album_category, album_id, category_id
        return $this->belongsToMany(Category::class)->withTimestamps(); //Un album puo' appartenere a tante categorie
    }
}
