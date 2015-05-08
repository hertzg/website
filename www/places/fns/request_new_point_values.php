<?php

function request_new_point_values ($key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'latitude' => '',
        'longitude' => '',
        'altitude' => '',
    ];

}
