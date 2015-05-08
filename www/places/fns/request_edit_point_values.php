<?php

function request_edit_point_values ($point, $key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'latitude' => $point->latitude,
        'longitude' => $point->longitude,
        'altitude' => $point->altitude,
    ];

}
