<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{

    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumb',
        'price',
        'series',
        'sale_date' => 'date',
        'type',
    ];

    protected $dates = ['sale_date'];
}
