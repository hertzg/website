<?php

namespace AdminApiKeys;

function getByName ($mysqli, $name, $exclude_id = 0) {
    $name = $mysqli->real_escape_string($name);
    $sql = 'select * from admin_api_keys'
        ." where name = '$name' and id != $exclude_id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
