<?php

// app/Models/Article.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    
    // Specify which attributes are mass assignable
    protected $fillable = [
        'title',
        'category',
        'keywords',
        'image',
        'content',
        'display_location',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

