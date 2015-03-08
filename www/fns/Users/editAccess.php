<?php

namespace Users;

function editAccess ($mysqli, $id, $access_time, $remote_address) {
    $remote_address = $mysqli->real_escape_string($remote_address);
    $sql = "update users set access_time = $access_time,"
        ." access_remote_address = '$remote_address' where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
