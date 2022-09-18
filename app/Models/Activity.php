<?php

namespace App\Models;

use App\Models\TouristExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'icon',
        'label'
    ];

    public function tourist_experiences()
    {
        return $this->belongsToMany(TouristExperience::class);
    }
}
