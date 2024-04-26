<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name'];

    public function albums()
    {
        return $this->belongsToMany(Album::class)->withTimestamps(); //Una categoria puo' appartenere a tanti album
    }
}
