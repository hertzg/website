<?php

namespace Users;

function get ($mysqli, $idusers) {
    $sql = "select * from users where idusers = $idusers";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
