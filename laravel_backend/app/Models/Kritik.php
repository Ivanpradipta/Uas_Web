<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kritik extends Model
{
    use HasFactory;

    /**
    * fillable
    *
    * @var array
    */
    protected $fillable = [
        'kritik',
        'saran',
        'nama',
        'email',
    ];
}