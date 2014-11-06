<?php

function require_mysql_config () {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/require_general_info.php';
    $generalInfoValues = require_general_info();

    $key = 'install/mysql-config/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect('../mysql-config/');
    }

    $values = $_SESSION[$key];
    $host = $values['host'];
    $username = $values['username'];
    $password = $values['password'];

    $mysqli = @new mysqli($host, $username, $password, $values['db']);
    if ($mysqli->connect_errno) {
        $_SESSION['install/mysql-config/error'] = $mysqli->connect_error;
        include_once "$fnsDir/redirect.php";
        redirect('../mysql-config/');
    }

    return [$generalInfoValues, $values, $mysqli];

}
