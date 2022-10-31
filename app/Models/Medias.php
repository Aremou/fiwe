<?php

namespace App\Models;

use App\Models\User;
use App\Models\Collection;
use App\Models\TouristExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function has_interest_centers()
    {
        return $this->hasMany(InterestCenter::class);
    }

    public function tourist_experiences()
    {
        return $this->hasMany(TouristExperience::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

}
