<?php
/**
 * Created by PhpStorm.
 * User: Diego
 * Date: 30/10/2018
 * Time: 10:42 AM
 */

if (!function_exists('fcm_push')) {

    /**
     * @param $title
     * @param $message
     * @param $device
     */

    function fcm_push($title, $message, $device)
    {
        if (!is_null($device)) {
            try {

                $fields =
                    [
                        'registration_ids' => $device,
                        "notification" => ["title" => $title, "sound" => "sound.mp3", "icon" => "fcm_push_icon", "color" => "#ec6920", "click_action" => "FCM_PLUGIN_ACTIVITY"],
                        "data" => [
                            "title" => $title,
                            "sound" => "sound.mp3",
                            "message" => $message,
                        ]
                    ];

                $server_key = env('FIREBASE_SERVER_KEY', '');
                $headers =
                    [
                        'Authorization: key=' . $server_key,
                        'Content-Type: application/json'
                    ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                curl_exec($ch);
                curl_close($ch);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }

}