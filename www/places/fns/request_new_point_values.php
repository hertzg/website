<?php

function request_new_point_values ($key) {
    if (array_key_exists($key, $_SESSION)) {
        $values = $_SESSION[$key];
    } else {
        $values = [
            'latitude' => '',
            'longitude' => '',
            'altitude' => '',
        ];
    }
    return $values;
}
