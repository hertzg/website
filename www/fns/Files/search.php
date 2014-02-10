<?php

namespace Files;

function search ($mysqli, $idusers, $idfolders, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = mysqli_real_escape_string($mysqli, $keyword);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from files'
        ." where idusers = $idusers"
        ." and idfolders = $idfolders"
        ." and filename like '%$keyword%'"
        .' order by filename'
    );

}
