<?php

namespace App\Models;

use App\Models\User;
use App\Models\Medias;
use App\Models\Geolocation;
use App\Models\InterestCenterCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InterestCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'description',
        'geolocation_id',
        'interest_center_category_id',
        'user_id',
        'is_active',
        'image_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Medias::class);
    }

    public function interest_center_category()
    {
        return $this->belongsTo(InterestCenterCategory::class);
    }

    public function medias()
    {
        return $this->belongsToMany(Medias::class)->orderBy('created_at', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function geolocation()
    {
        return $this->belongsTo(Geolocation::class);
    }

}
