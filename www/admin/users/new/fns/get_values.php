<?php

function get_values () {

    $key = 'admin/users/new/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'focus' => 'username',
        'username' => '',
        'password' => '',
        'repeatPassword' => '',
        'admin' => false,
        'disabled' => false,
        'expires' => false,
    ];

}
