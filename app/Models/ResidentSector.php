<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentSector extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'sector_id',
    ];
}
