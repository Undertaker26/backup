<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

protected $fillable = [
    'name',
    'position',
    'parent_id',
    'image',
    'category',
];


public function parent()
{
    return $this->belongsTo(Organization::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(Organization::class, 'parent_id');

}
}