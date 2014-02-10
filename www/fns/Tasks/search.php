<?php

namespace Tasks;

function search ($mysqli, $idusers, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);

    $keyword = mysqli_real_escape_string($mysqli, $keyword);

    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object(
        $mysqli,
        'select * from tasks'
        ." where idusers = $idusers and tasktext like '%$keyword%'"
        .' order by done, updatetime desc'
    );

}
