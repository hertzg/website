<?php

namespace Invitations;

function getByKey ($mysqli, $key) {
    $key = $mysqli->real_escape_string($key);
    $sql = "select * from invitations where `key` = '$key'";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
