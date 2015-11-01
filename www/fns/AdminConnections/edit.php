<?php

namespace AdminConnections;

function edit ($mysqli, $id, $address, $their_exchange_api_key, $expire_time) {

    $address = $mysqli->real_escape_string($address);
    if ($their_exchange_api_key === null) $their_exchange_api_key = 'null';
    else {
        $their_exchange_api_key = $mysqli->real_escape_string(
            $their_exchange_api_key);
        $their_exchange_api_key = "'$their_exchange_api_key'";
    }
    if ($expire_time === null) $expire_time = 'null';
    $update_time = time();

    $sql = "update admin_connections set address = '$address',"
        ." their_exchange_api_key = $their_exchange_api_key,"
        ." expire_time = $expire_time, revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
