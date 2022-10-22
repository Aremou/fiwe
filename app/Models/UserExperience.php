<?php

namespace App\Models;

use App\Models\User;
use App\Models\TouristExperience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserExperience extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tourist_experience_id',
        'price',
        'disponibility',
        'status',
        'transaction_id',
        'quantity',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function tourist_experience()
    {
        return $this->belongsTo(TouristExperience::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
