<?php

function get_values () {

    $key = 'install/mysql-settings/values';
    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    $username = exec('whoami', $username);
    return [
        'host' => 'localhost',
        'username' => $username,
        'password' => '',
        'db' => 'zvini',
        'create' => true,
        'check' => false,
    ];

}
