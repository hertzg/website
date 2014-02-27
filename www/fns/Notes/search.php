<?php

namespace Notes;

function search ($mysqli, $idusers, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = $mysqli->real_escape_string($keyword);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from notes'
        ." where idusers = $idusers and notetext like '%$keyword%'"
        .' order by updatetime desc'
    );

}
