<?php

namespace Files;

function searchInFolder ($mysqli, $idusers, $idfolders, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select * from files'
        ." where idusers = $idusers"
        ." and idfolders = $idfolders"
        ." and filename like '%$keyword%'"
        .' order by filename';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
