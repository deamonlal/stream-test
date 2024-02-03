<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDistribution extends Model
{
    use HasFactory;

    protected $table = 'book_distributions';

    protected $fillable = [
        'book_id',
        'reader_id',
        'distribution_date',
        'return_date',
        'must_be_returned_at',
    ];

    protected $guarded = false;
}
