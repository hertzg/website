<?php

function create_page_load_response ($user = null) {

    include_once __DIR__.'/client_time_and_timezone.php';
    client_time_and_timezone($user, $time, $timezone);

    $response = [
        'time' => $time,
        'timezone' => $timezone,
    ];

    if ($user) {

        $themeColor = $user->theme_color;

        include_once __DIR__.'/get_sign_out_timeout.php';
        $response['signOutTimeout'] = get_sign_out_timeout();

        $response['user'] = [];

        if (array_key_exists('token', $_SESSION)) {
            $response['session_remembered'] = true;
        }

    } else {
        include_once __DIR__.'/Theme/Color/getDefault.php';
        $themeColor = Theme\Color\getDefault();
    }

    $response['themeColor'] = $themeColor;

    return $response;

}
