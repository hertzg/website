<?php

function request_api_key_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($name) = request_strings('name');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    include_once __DIR__.'/request_expires.php';
    request_expires($expires, $expire_time);

    return [$name, $expires, $expire_time];

}
