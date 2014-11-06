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

    $values = $_SESSION[$key];

    $invalid = function () {
        include_once "$fnsDir/redirect.php";
        redirect('../admin/');
    };

    include_once "$fnsDir/Username/isValid.php";
    if (!Username\isValid($values['username'])) $invalid();

    $password1 = $values['password1'];
    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password1) || $password1 !== $values['password2']) {
        $invalid();
    }

    return [$generalInfoValues, $mysqlConfigValues, $values, $mysqli];

}
