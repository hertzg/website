<?php

namespace SendForm;

function checkExternalRecipients ($mysqli, &$recipients, &$errors) {

    $addresses = [];
    foreach ($recipients as $recipient) {
        $addresses[$recipient['address']] = true;
    }
    $addresses = array_keys($addresses);

    include_once __DIR__.'/../AdminConnections/getByAddresses.php';
    $adminConnections = \AdminConnections\getByAddresses($mysqli, $addresses);

    $addresses = [];
    foreach ($adminConnections as $adminConnection) {
        $addresses[$adminConnection->address] = $adminConnection;
    }

    $unavailable_address = [];
    foreach ($recipients as &$recipient) {
        $address = $recipient['address'];
        if (array_key_exists($address, $addresses)) {
            $recipient['their_exchange_api_key'] =
                $addresses[$address]->their_exchange_api_key;
        } else {
            $unavailable_address[$address] = true;
        }
    }
    unset($recipient);

    foreach ($unavailable_address as $address => $value) {
        $errors[] = 'Sending to anyone at "'
            .htmlspecialchars($address).'" is no longer available.';
    }

}
