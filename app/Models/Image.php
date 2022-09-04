<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'contextid',
        'component',
        'filename',
        'is_active',
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
