<?php

function require_admin () {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/require_mysql_config.php';
    $values = require_mysql_config();
    list($generalInfoValues, $mysqlConfigValues, $mysqli) = $values;

    $key = 'install/admin/values';
    if (!array_key_exists($key, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        redirect('../admin/');
    }

    $adminValues = $_SESSION[$key];

    include_once __DIR__.'/check_admin.php';
    $error = check_admin($adminValues['username'],
        $adminValues['password1'], $adminValues['password2']);

    if ($error) {
        $_SESSION['install/admin/error'] = $error;
        include_once "$fnsDir/redirect.php";
        redirect('../admin/');
    };

    return [$generalInfoValues, $mysqlConfigValues, $adminValues, $mysqli];

}
