<?php

namespace Files;

function get ($mysqli, $id_users, $id) {
    $sql = 'select * from files'
        ." where id_users = $id_users and id_files = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
