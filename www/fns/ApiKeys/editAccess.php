<?php

namespace ApiKeys;

function editAccess ($mysqli, $id, $access_time, $remote_address) {
    $remote_address = $mysqli->real_escape_string($remote_address);
    $sql = "update api_keys set access_time = $access_time,"
        ." access_remote_address = '$remote_address' where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
