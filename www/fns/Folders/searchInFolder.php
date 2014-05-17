<?php

namespace Folders;

function searchInFolder ($mysqli, $id_users, $parent_id_folders, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select * from folders'
        ." where id_users = $id_users"
        ." and parent_id_folders = $parent_id_folders"
        ." and name like '%$keyword%'"
        .' order by name';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
