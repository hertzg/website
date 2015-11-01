<?php

namespace AdminConnections;

function getByAddress ($mysqli, $address, $exclude_id = 0) {
    $address = $mysqli->real_escape_string($address);
    $sql = 'select * from admin_connections'
        ." where address = '$address' and id != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
