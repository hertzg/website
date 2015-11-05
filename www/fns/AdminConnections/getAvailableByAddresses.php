<?php

namespace AdminConnections;

function getAvailableByAddresses ($mysqli, $addresses) {

    foreach ($addresses as &$address) {
        $address = "'".$mysqli->real_escape_string($address)."'";
    }
    unset($address);

    $sql = 'select * from admin_connections'
        .' where their_exchange_api_key is not null'
        .' and address in ('.join(', ', $addresses).')';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
