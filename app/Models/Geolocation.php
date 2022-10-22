<?php

namespace App\Models;

use App\Models\InterestCenter;
use App\Models\TouristExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Geolocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];

    public function tourist_experiences()
    {
        return $this->hasMany(TouristExperience::class);
    }

    public function interest_centers()
    {
        return $this->hasMany(InterestCenter::class);
    }
}
