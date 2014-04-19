<?php

namespace ApiKeys;

function getOnUserByName ($mysqli, $id_users, $name) {
    $name = $mysqli->real_escape_string($name);
    $sql = 'select * from api_keys'
        ." where id_users = $id_users and name = '$name'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
