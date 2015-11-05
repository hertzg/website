<?php

namespace AdminConnections;

function getAvailableByAddress ($mysqli, $address) {
    include_once __DIR__.'/getByAddress.php';
    $adminConnection = getByAddress($mysqli, $address);
    if ($adminConnection && $adminConnection->their_exchange_api_key !== null) {
        return $adminConnection;
    }
}
