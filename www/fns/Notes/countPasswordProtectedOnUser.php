<?php

namespace Notes;

function countPasswordProtectedOnUser ($mysqli, $id_users) {
    $sql = 'select count(*) value from notes'
        ." where password_protect and id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
