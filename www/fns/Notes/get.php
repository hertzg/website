<?php

namespace Notes;

function get ($mysqli, $id_users, $id) {
    $sql = 'select * from notes'
        ." where id_users = $id_users and id_notes = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
