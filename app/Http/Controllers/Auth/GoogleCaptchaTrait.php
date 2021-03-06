<?php

namespace App\Http\Controllers\Auth;

trait GoogleCaptchaTrait
{
    public function reCaptchaRequest($response)
    {
        $data = array(
            'secret' => env('RE_CAPTCHA_SECRET'),
            'response' => $response
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($verify));

        return $response->success;
    }
}