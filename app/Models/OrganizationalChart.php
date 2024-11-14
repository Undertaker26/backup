<?php

// app/Models/OrganizationalChart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationalChart extends Model
{
    // Define the table name if it differs from the default 'organizational_charts'
    protected $table = 'organizational_charts';

    // Define the fillable fields (adjust based on your database structure)
    protected $fillable = ['name', 'position', 'parent_id'];
}
