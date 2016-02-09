<?php

function create_page_load_response ($user = null) {

    include_once __DIR__.'/client_time_and_timezone.php';
    client_time_and_timezone($user, $time, $timezone);

    $response = [
        'time' => $time,
        'timezone' => $timezone,
    ];

    if ($user) {
        $response['user'] = [
            'theme_color' => $user->theme_color,
        ];
    }

    return $response;

}
