<?php

namespace Connections;

function getByUsernameAddress ($mysqli,
    $id_users, $username, $address, $exclude_id = 0) {

    $username = $mysqli->real_escape_string($username);
    $address = $mysqli->real_escape_string($address);

    $sql = "select * from connections where id_users = $id_users"
        ." and username = '$username' and address = '$address'"
        ." and id != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);

}
