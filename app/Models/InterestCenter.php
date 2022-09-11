<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\InterestCenterCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InterestCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'description',
        'lat',
        'long',
        'user_id',
        'interest_center_category_id',
        'is_active',
        'picture',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interest_center_category()
    {
        return $this->belongsTo(InterestCenterCategory::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

}
