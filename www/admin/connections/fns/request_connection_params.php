<?php

function request_connection_params ($mysqli,
    &$errors, &$focus, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/AdminConnections/request.php";
    list($address, $their_exchange_api_key) = AdminConnections\request();

    include_once "$fnsDir/request_strings.php";
    list($expires) = request_strings('expires');

    include_once "$fnsDir/parse_expire_time.php";
    parse_expire_time($expires, $expire_time);

    if ($address === '') {
        $errors[] = 'Enter address.';
        $focus = 'address';
    } else {
        include_once "$fnsDir/ConnectionAddress/isValid.php";
        if (ConnectionAddress\isValid($address)) {
            include_once "$fnsDir/AdminConnections/getByAddress.php";
            $connection = AdminConnections\getByAddress(
                $mysqli, $address, $exclude_id);
            if ($connection) {
                $errors[] = 'A connection with this address already exists.';
                $focus = 'address';
            }
        } else {
            $errors[] = 'The address is invalid.';
            $focus = 'address';
        }
    }

    if ($their_exchange_api_key === '') $their_exchange_api_key = null;
    else {
        include_once "$fnsDir/ApiKey/isValid.php";
        if (!ApiKey\isValid($their_exchange_api_key)) {
            $errors[] = 'Their key is invalid.';
            if ($focus === null) $focus = 'their_exchange_api_key';
        }
    }

    return [$address, $their_exchange_api_key, $expires, $expire_time];

}
