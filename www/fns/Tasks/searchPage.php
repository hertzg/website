<?php

namespace Tasks;

function searchPage ($mysqli, $id_users, $keyword, $offset, $limit, &$total) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select count(*) total from tasks'
        ." where id_users = $id_users and text like '%$keyword%'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = 'select * from tasks'
        ." where id_users = $id_users and text like '%$keyword%'"
        .' order by top_priority desc, update_time desc'
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
