<?php

namespace SendForm;

function checkUsernameAddress ($mysqli, $username,
    $parsed_username, $address, $checkFunction, &$errors) {

    if ($address === null) {
        $checkFunction($username, $errors);
        return;
    }

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Username/isValid.php";
    if (!\Username\isValid($parsed_username)) {
        $errors[] = 'The username is invalid.';
        return;
    }

    include_once "$fnsDir/ConnectionAddress/isValid.php";
    if (!\ConnectionAddress\isValid($address)) {
        $errors[] = 'The username is invalid.';
        return;
    }

    include_once "$fnsDir/AdminConnections/getAvailableByAddress.php";
    $adminConnection = \AdminConnections\getAvailableByAddress(
        $mysqli, $address);
    if (!$adminConnection) {
        $errors[] = 'Sending to anyone at "'
            .htmlspecialchars($address).'" is unavailable.';
    }

}
