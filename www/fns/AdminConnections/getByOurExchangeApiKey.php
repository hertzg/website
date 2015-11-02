<?php

namespace AdminConnections;

function getByOurExchangeApiKey ($mysqli, $our_exchange_api_key) {
    $our_exchange_api_key = $mysqli->real_escape_string($our_exchange_api_key);
    $sql = 'select * from admin_connections'
        ." where our_exchange_api_key = '$our_exchange_api_key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
