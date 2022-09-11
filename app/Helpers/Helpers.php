<?php

use App\Models\User;
use App\Models\Image;
use Twilio\Rest\Client;
use App\Models\InterestCenterCategory;

if (!function_exists('background_color_1')) {
    function background_color_1()
    {
        return 'background-color: #FC6307';
    }
}
if (!function_exists('color_1')) {
    function color_1()
    {
        return 'color: #FC6307';
    }
}

if (!function_exists('generate_code_user')) {
    function generate_code_user($user)
    {

        do {
            $code = rand(100000, 999999);

            $code_exist = User::where('phone_verified', $code)->first();
        } while ( $code_exist != null);

        $user->update([
            'phone_verified' => $code,
        ]);

        return $code;

    }
}

if (!function_exists('send_sms')) {
    function send_sms($phone, $code)
    {
        $client = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));
        $client->messages->create('+229' . $phone,
                [
                    'from' => getenv("TWILIO_NUMBER"),
                    'body' => $code
                ]);
    }
}

if (!function_exists('j_json_decode')) {
    function j_json_decode($value, $lang)
    {
        return json_decode($value)->$lang ?? '';
    }
}

if (!function_exists('interest_center_categories')) {
    function interest_center_categories()
    {
        return InterestCenterCategory::all();
    }
}