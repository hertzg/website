<?php

namespace Places;

function countOnUser ($mysqli, $id_users) {
    $sql = "select count(*) value from places where id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
