<?php

namespace Users;

function get ($mysqli, $id_users) {
    $sql = "select * from users where id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
