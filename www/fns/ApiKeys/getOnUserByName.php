<?php

namespace ApiKeys;

function getOnUserByName ($mysqli, $id_users, $name, $exclude_id = 0) {
    $name = $mysqli->real_escape_string($name);
    $sql = 'select * from api_keys'
        ." where id_users = $id_users and name = '$name'"
        ." and id != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
