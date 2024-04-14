<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    protected $appends = ['poster_url'];

    public function getPosterUrlAttribute()
    {
        if ($this->poster) {
            return Storage::url($this->poster);
        }
        return null; // Return null or a placeholder image path if the poster is not available
    }
    use HasFactory;
}
