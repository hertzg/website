<?php

namespace Folders;

function search ($mysqli, $id_users, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select * from folders'
        ." where id_users = $id_users"
        ." and folder_name like '%$keyword%'"
        .' order by folder_name';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
