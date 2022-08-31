<?php

namespace App\Models;

use App\Models\User;
use App\Models\InterestCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fullname',
        'birth_date',
        'civility',
        'birth_country',
        'badge',
        'game_level',
        'experience_count',
        'cover_picture',
        'certify',
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interest_centers()
    {
        return $this->hasMany(InterestCenter::class);
    }
}
