<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;

    protected $table = 'readers';

    protected $fillable = [
        'first_name',
        'last_name',
        'date_birth',
        'address',
        'phone_number',
    ];

    protected $guarded = false;
}
