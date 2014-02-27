<?php

namespace Folders;

function searchInFolder ($mysqli, $idusers, $parentidfolders, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select * from folders'
        ." where idusers = $idusers"
        ." and parentidfolders = $parentidfolders"
        ." and foldername like '%$keyword%'"
        .' order by foldername';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
