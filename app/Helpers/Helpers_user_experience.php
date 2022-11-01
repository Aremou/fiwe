<?php

if (!function_exists('format_user_experience')) {
    function format_user_experience($user_experience)
    {
        return [
            'id' => $user_experience->id,
            'user_id' => $user_experience->user_id,
            'tourist_experience_id' => $user_experience->tourist_experience_id,
            'label' => $user_experience->label,
            'amount' => (string)$user_experience->amount ,
            'disponibility' => $user_experience->disponibility,
            'status' => $user_experience->status,
            'quantity' => $user_experience->quantity,
            'created_at' => $user_experience->created_at,
            'updated_at' => $user_experience->updated_at
        ];
    }
}

