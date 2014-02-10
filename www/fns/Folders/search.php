<?php

namespace Folders;

function search ($mysqli, $idusers, $parentidfolders, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = mysqli_real_escape_string($mysqli, $keyword);

    include_once __DIR__.'/../mysqli_query_object.php';

    return mysqli_query_object(
        $mysqli,
        'select * from folders'
        ." where idusers = $idusers"
        ." and parentidfolders = $parentidfolders"
        ." and foldername like '%$keyword%'"
        .' order by foldername'
    );

}
