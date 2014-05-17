<?php

namespace Files;

function searchInFolder ($mysqli, $id_users, $id_folders, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select * from files'
        ." where id_users = $id_users"
        ." and id_folders = $id_folders"
        ." and name like '%$keyword%'"
        .' order by name';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
