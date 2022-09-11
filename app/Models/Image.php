<?php

namespace App\Models;

use App\Models\InterestCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'is_active',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function interest_centers()
    {
        return $this->belongsToMany(InterestCenter::class);
    }
}
