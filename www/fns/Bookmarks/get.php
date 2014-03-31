<?php

namespace Bookmarks;

function get ($mysqli, $id_users, $id) {
    $sql = 'select * from bookmarks'
        ." where id_users = $id_users and id_bookmarks = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
