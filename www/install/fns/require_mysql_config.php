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

    $mysqlConfigValues = $_SESSION[$key];

    include_once __DIR__.'/check_mysql_config.php';
    $error = check_mysql_config($mysqlConfigValues['host'],
        $mysqlConfigValues['username'], $mysqlConfigValues['password'],
        $mysqlConfigValues['db'], $mysqlConfigValues['create'],
        $mysqli, $focus);

    if ($error) {
        include_once "$fnsDir/redirect.php";
        redirect('../mysql-config/');
    }

    return [$generalInfoValues, $mysqlConfigValues, $mysqli];

}
