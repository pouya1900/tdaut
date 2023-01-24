<?php

namespace App\Services;

class hampa
{

    private $key;
    private $base;

    public function __construct()
    {
        $string = "WLF";
        $date = date('Y/m/d H:i', strtotime('now'));
        $this->key = md5($string . $date);
        $this->base = "https://itech.aut.ac.ir";
    }

    public function login($member, $pass)
    {
        $service_url = $this->base . '/api/login';

        $post_data = [
            'username'   => $member->profile->username,
            'password'   => $pass,
            'public_key' => $this->key,
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $service_url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        $result = curl_exec($ch);
        $response = json_decode($result, true);
        curl_close($ch);
    }

}
