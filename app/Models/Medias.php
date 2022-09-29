<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'is_active',
        'user_id',
        'mimetype',
        'created_at',
        'updated_at',
    ];

    public function interest_centers()
    {
        return $this->belongsToMany(InterestCenter::class);
    }
}
