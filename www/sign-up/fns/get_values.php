<?php

function get_values () {

    $key = 'sign-up/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    include_once __DIR__.'/../../fns/request_strings.php';
    list($return) = request_strings('return');

    return [
        'username' => '',
        'password' => '',
        'repeatPassword' => '',
        'email' => '',
        'return' => $return,
    ];

}
