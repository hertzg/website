<?php

namespace Folders;

function indexInUserFolder ($mysqli, $id_users, $parent_id) {
    $sql = "select * from folders where id_users = $id_users"
        ." and parent_id = $parent_id order by name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
