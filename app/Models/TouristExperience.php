<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TouristExperience extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'description',
        'city',
        'unit_price',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
