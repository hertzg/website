<?php

function get_values () {

    $key = 'install/admin/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    return [
        'username' => 'adminadmin',
        'password' => '',
        'repeatPassword' => '',
        'check' => false,
    ];

}
