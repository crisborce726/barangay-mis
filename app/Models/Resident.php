<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_no',
        'firstname',
        'middlename',
        'lastname',
        'birth_date',
        'suffix',
        'gender',
        'phone_number',
        'sitio',
        'barangay_id',
        'status',
    ];
}