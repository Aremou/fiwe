<?php

namespace App\Models;

use App\Models\Medias;
use App\Models\Activity;
use App\Models\Geolocation;
use App\Models\Disponibility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TouristExperience extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'description',
        'city',
        'unit_price',
        'image_id',
        'video_id',
        'geolocation_id',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function disponibilities()
    {
        return $this->belongsToMany(Disponibility::class);
    }

    public function user_experiences()
    {
        return $this->hasMany(UserExperience::class);
    }

    public function medias()
    {
        return $this->belongsTo(Medias::class);
    }

    public function geolocation()
    {
        return $this->belongsTo(Geolocation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
