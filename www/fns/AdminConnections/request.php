<?php

namespace AdminConnections;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($address, $their_exchange_api_key) = request_strings(
        'address', 'their_exchange_api_key');

    $address = preg_replace('/\s+/', '', $address);

    include_once "$fnsDir/ConnectionAddress/maxLength.php";
    $address = mb_substr($address, 0, \ConnectionAddress\maxLength(), 'UTF-8');

    return [$address, $their_exchange_api_key];

}
