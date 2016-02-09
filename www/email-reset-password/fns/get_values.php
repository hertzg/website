<?php

function get_values () {

    $key = 'email-reset-password/values';
    if (array_key_exists($key, $_SESSION)) return$_SESSION[$key];

    include_once '../fns/request_strings.php';
    list($return) = request_strings('return');

    return [
        'focus' => 'email',
        'email' => '',
        'return' => $return,
    ];

}
