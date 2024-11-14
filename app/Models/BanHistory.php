<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanHistory extends Model
{
    // Define the table associated with the model if it's not the plural form of the model name
    protected $table = 'ban_histories';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'ban_reason',
        'ban_duration',
        // Add any other attributes that you want to allow for mass assignment
    ];

    // If you have timestamps in your table and want to use them
    public $timestamps = true;
}
