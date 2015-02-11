<?php

namespace Folders;

function countOnUser ($mysqli, $id_users) {
    $sql = "select count(*) value from folders where id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
