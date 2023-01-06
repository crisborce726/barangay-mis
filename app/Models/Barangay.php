<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay',
        'municipality',
        'province',
        'postal_id',
        'phone_number',
        'email_add',
    ];

}