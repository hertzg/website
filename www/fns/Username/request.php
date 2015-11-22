<?php

namespace Username;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');

    $username = preg_replace('/\s+/', '', $username);

    include_once __DIR__.'/maxLength.php';
    return mb_substr($username, 0, maxLength(), 'UTF-8');

}
