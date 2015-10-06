<?php

namespace Users;

function count ($mysqli) {
    $sql = 'select count(*) total from users';
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->total;
}
