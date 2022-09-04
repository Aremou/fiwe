<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExperience extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tourist_experience_id',
        'price',
        'disponibility',
        'status',
        'transaction_id',
        'quantity',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
