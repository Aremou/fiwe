<?php

namespace App\Models;

use App\Models\Account;
use App\Models\AdminAccount;
use App\Models\InterestCenter;
use App\Models\UserExperience;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'phone_verified',
        'profil_image_id',
        'cover_image_id',
        'is_active',
        'password',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function admin_accounts()
    {
        return $this->hasMany(AdminAccount::class);
    }

    public function interest_centers()
    {
        return $this->hasMany(InterestCenter::class);
    }

    public function like_interest_centers()
    {
        return $this->belongsToMany(InterestCenter::class);
    }

    public function user_experiences()
    {
        return $this->hasMany(UserExperience::class);
    }
}
