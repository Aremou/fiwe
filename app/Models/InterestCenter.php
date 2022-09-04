<?php

namespace App\Models;

use App\Models\Account;
use App\Models\AdminAccount;
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
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function admin_account()
    {
        return $this->belongsTo(AdminAccount::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function interest_center_category()
    {
        return $this->belongsTo(InterestCenterCategory::class);
    }

}
