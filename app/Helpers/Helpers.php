<?php

use App\Models\User;
use Kkiapay\Kkiapay;
use Twilio\Rest\Client;
use App\Models\Geolocation;
use App\Mail\SendCodeByEmail;
use Illuminate\Support\Facades\Mail;
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

if (!function_exists('send_code_by_mail')) {
    function send_code_by_mail($mail, $code)
    {
        Mail::to($mail)->send(new SendCodeByEmail($code));
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

if (!function_exists('create_location')) {
    function create_location($lat, $lng, $label = null)
    {
        $location = Geolocation::create([
            'label' => $label,
            'latitude' => $lat,
            'longitude' => $lng,
        ]);

        return $location;
    }
}

if (!function_exists('edit_location')) {
    function edit_location($id, $lat, $lng)
    {
        $location = Geolocation::findOrfail($id);

        $location->update([
            'latitude' => $lat,
            'longitude' => $lng,
        ]);

        return $location;
    }
}

if (!function_exists('show_location')) {
    function show_location($id)
    {
        $location = Geolocation::find($id);

        if(!$location){
            return null;
        }

        return (object)[
            'label' => $location->label,
            'latitude' => (float)$location->latitude,
            'longitude' => (float)$location->longitude,
        ];
    }
}

if (!function_exists('use_disponibility')) {
    function use_disponibility($disponibility)
    {
        return $disponibility->with('tourist_experiences')->get();
    }
}

if (!function_exists('slug_privacy_policy')) {
    function slug_privacy_policy()
    {
        return "privacy-policy";
    }
}

if (!function_exists('slug_terms_of_use')) {
    function slug_terms_of_use()
    {
        return "terms-of-use";
    }
}

if (!function_exists('format_boolean')) {
    function format_boolean($value)
    {
        return $value == 1 ? true : false;
    }
}

if(!function_exists('kkiapay')){
    function kkiapay($id_transaction){
        $public_key = "9f2b65004b0e11ed958fbf3ec63d1ffd" ;
        $private_key = "tpk_9f2b8c114b0e11ed958fbf3ec63d1ffd";
        $secret = "tsk_9f2b8c124b0e11ed958fbf3ec63d1ffd";

        $kkiapay = new Kkiapay($public_key, $private_key, $secret, $sandbox=true);

        return $kkiapay->verifyTransaction($id_transaction);

    }
}
