<?php

function get_values () {

    $key = 'accept-invitation/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'username' => '',
        'password' => '',
        'repeatPassword' => '',
        'email' => '',
    ];

}
