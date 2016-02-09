<?php

function create_page_load_response ($user = null) {

    include_once __DIR__.'/client_time_and_timezone.php';
    client_time_and_timezone($user, $time, $timezone);

    $response = [
        'time' => $time,
        'timezone' => $timezone,
    ];

    if ($user) {

        include_once __DIR__.'/get_sign_out_timeout.php';
        $response['signOutTimeout'] = get_sign_out_timeout();

        $response['user'] = ['theme_color' => $user->theme_color];

        if (array_key_exists('token', $_SESSION)) {
            $response['session_remembered'] = true;
        }

    }

    return $response;

}
