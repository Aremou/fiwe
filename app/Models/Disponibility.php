<?php

namespace App\Models;

use App\Models\TouristExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disponibility extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'count'
    ];

    public function tourist_experiences()
    {
        return $this->belongsToMany(TouristExperience::class);
    }

}
