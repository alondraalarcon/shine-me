<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rider_info extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'image'
    ];
}
