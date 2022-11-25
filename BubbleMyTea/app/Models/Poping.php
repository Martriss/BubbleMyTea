<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poping extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'name',
        'price'
    ];
}
