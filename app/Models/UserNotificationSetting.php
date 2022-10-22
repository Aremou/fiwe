<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserNotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'new_post',
        'like_mention',
        'comments',
        'discussions_answers',
        'program_reminder',
        'new_tourist_experience',
        'nearby_players',
        'share_experiences',
        'repeat_unread_notifications',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
