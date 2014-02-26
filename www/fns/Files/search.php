<?php

namespace Files;

function search ($mysqli, $idusers, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = mysqli_real_escape_string($mysqli, $keyword);

    $sql = 'select * from files'
        ." where idusers = $idusers"
        ." and filename like '%$keyword%'"
        .' order by filename';

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
