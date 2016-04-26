<?php

function get_values () {

    $key = 'sign-in/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    include_once __DIR__.'/../../fns/request_strings.php';
    list($username, $return) = request_strings('username', 'return');

    if ($username === '') {
        if (array_key_exists('username', $_COOKIE)) {
            $username = $_COOKIE['username'];
            if (!is_string($username)) $username = '';
        } else {
            $username = '';
        }
    }

    return [
        'focus' => 'username',
        'username' => $username,
        'password' => '',
        'remember' => array_key_exists('remember', $_COOKIE),
        'return' => $return,
    ];

}
