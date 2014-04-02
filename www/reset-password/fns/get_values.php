<?php

function get_values () {
    $key = 'reset-password/values';
    if (array_key_exists($key, $_SESSION)) {
        return $_SESSION[$key];
    }
    return [
        'password1' => '',
        'password2' => '',
    ];
}
