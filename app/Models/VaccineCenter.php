<?php

// app/Models/VaccineCenter.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'daily_limit'];

    // Define relationships here if needed
}
