<?php

namespace Tokens;

function countOnUser ($mysqli, $id_users) {
    $sql = "select count(*) value from tokens where id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
