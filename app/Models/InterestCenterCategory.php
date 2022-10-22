<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestCenterCategory extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'deleted_at', 'created_at', 'updated_at'];


    public function interest_centers()
    {
        return $this->hasMany(InterestCenter::class);
    }
}
