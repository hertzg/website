<?php

namespace SendForm;

function requestUsernameAddress (&$username, &$address) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');
    $username = preg_replace('/\s+/', '', $username);

    include_once "$fnsDir/parse_username_address.php";
    parse_username_address($username, $parsed_username, $address);

}
