<?php

function require_admin_connection (&$adminConnection, &$mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($exchange_api_key) = request_strings('exchange_api_key');

    include_once "$fnsDir/require_mysqli.php";
    $mysqli = require_mysqli();

    include_once "$fnsDir/AdminConnections/getByOurExchangeApiKey.php";
    $adminConnection = AdminConnections\getByOurExchangeApiKey(
        $mysqli, $exchange_api_key);

    if (!$adminConnection) {
        include_once "$fnsDir/ApiCall/Error/forbidden.php";
        ApiCall\Error\forbidden('"INVALID_EXCHANGE_API_KEY"');
    }

    $time = time();

    $expire_time = $adminConnection->expire_time;
    if ($expire_time !== null && $expire_time < $time) {
        include_once "$fnsDir/ApiCall/Error/forbidden.php";
        ApiCall\Error\forbidden('"EXCHANGE_API_KEY_EXPIRED"');
    }

    include_once "$fnsDir/ClientAddress/get.php";
    $client_address = ClientAddress\get();

    $access_time = $adminConnection->access_time;
    if ($access_time === null || $access_time + 30 < $time ||
        $adminConnection->access_remote_address !== $client_address) {

        include_once "$fnsDir/AdminConnections/editAccess.php";
        AdminConnections\editAccess($mysqli,
            $adminConnection->id, $time, $client_address);

    }

    include_once "$fnsDir/AdminConnectionAuths/add.php";
    AdminConnectionAuths\add($mysqli, $adminConnection->id, $client_address);

}
