<?php

namespace Tasks;

function search ($mysqli, $id_users, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select * from tasks'
        ." where id_users = $id_users and text like '%$keyword%'"
        .' order by top_priority desc, update_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
