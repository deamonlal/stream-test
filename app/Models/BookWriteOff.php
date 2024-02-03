<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookWriteOff extends Model
{
    use HasFactory;

    protected $table = 'book_write_offs';

    protected $fillable = [
        'book_id',
        'copies',
        'reason',
        'date',
    ];

    protected $guarded = false;
}
