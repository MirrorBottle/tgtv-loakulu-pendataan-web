<?php

namespace App\Traits;

use App\Models\User;

trait PushNotificationTrait
{

    public $url = "https://fcm.googleapis.com/fcm/send";
    public $server_key = "AAAAAvsAwdk:APA91bGlVpPijfJwUIYYErjcnrummvkS-eY695WC8WXXPXIipcn8WgEc4Ly36rgx8cbg8WLFZxNl_rDXC2gJ80wPDfKVhDAUYR3zfgNgmDt2kkQzaUWTUtHq-ZMwbszESyC5lweoXc0h";

    public function pushNotificationToUser($user_id, $title = 'NRA', $body = '-', $data = ['message' => 'notif'])
    {
        $user = User::find($user_id);
        $data = [
            "registration_ids" => [$user->device_token],
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            "data" => $data
        ];
        $encoded_data = json_encode($data);

        $headers = [
            'Authorization:key=' . $this->server_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_data);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        // FCM response
        return $result;
    }

    public function pushNotificationToAdmins($title = 'NRA', $body = '-', $data = ['message' => 'notif'])
    {
        $tokens = User::select('device_token')
            ->whereHas("roles", function($q){ $q->where("role_id", 1); })
            ->whereNotNull('device_token')
            ->pluck('device_token');
        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            "data" => $data
        ];
        $encoded_data = json_encode($data);

        $headers = [
            'Authorization:key=' . $this->server_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_data);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        // FCM response
        return $result;
    }

    public function pushNotificationToTopic($title = 'NRA', $body = '-', $topic = 'users', $data = ['message' => 'notif'])
    {
        $data = [
            "to" => "/topics/$topic",
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            "data" => $data
        ];
        $encoded_data = json_encode($data);

        $headers = [
            'Authorization:key=' . $this->server_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_data);

        // Execute post
        $result = curl_exec($ch);
        dd($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        // FCM response
        return $result;
    }
}
