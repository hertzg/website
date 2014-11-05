<?php

function require_values () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/session_start_custom.php";
    session_start_custom();

    $key = 'install/finalize/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect('../mysql-config/');
    }

    $values = $_SESSION[$key];
    $host = $values['host'];
    $username = $values['username'];

    $mysqli = @new mysqli($host, $username, $values['password'], $values['db']);
    if ($mysqli->connect_errno) {
        $_SESSION['install/mysql-config/error'] = $mysqli->connect_error;
        unset($_SESSION[$key]);
        include_once "$fnsDir/redirect.php";
        redirect('../mysql-config/');
    }

    return [$values, $mysqli];

}
