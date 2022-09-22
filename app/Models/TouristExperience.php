<?php

namespace App\Models;

use App\Models\Activity;
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
}
