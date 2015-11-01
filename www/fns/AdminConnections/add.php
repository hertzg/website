<?php

namespace AdminConnections;

function add ($mysqli, $address, $their_exchange_api_key, $expire_time) {

    include_once __DIR__.'/../ApiKey/random.php';
    $our_exchange_api_key = \ApiKey\random();

    $address = $mysqli->real_escape_string($address);
    if ($their_exchange_api_key === null) $their_exchange_api_key = 'null';
    else {
        $their_exchange_api_key = $mysqli->real_escape_string(
            $their_exchange_api_key);
        $their_exchange_api_key = "'$their_exchange_api_key'";
    }
    if ($expire_time === null) $expire_time = 'null';
    $insert_time = $update_time = time();

    $sql = 'insert into admin_connections'
        .' (`our_exchange_api_key`,'
        .' address, their_exchange_api_key,'
        .' expire_time, insert_time, update_time)'
        ." values ('$our_exchange_api_key',"
        ." '$address', $their_exchange_api_key,"
        ." $expire_time, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
