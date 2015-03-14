<?php

function request_edit_point_values ($point, $key) {
    if (array_key_exists($key, $_SESSION)) {
        $values = $_SESSION[$key];
    } else {
        $values = [
            'latitude' => $point->latitude,
            'longitude' => $point->longitude,
            'altitude' => $point->altitude,
        ];
    }
    return $values;
}
