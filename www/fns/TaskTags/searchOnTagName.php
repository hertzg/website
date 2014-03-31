<?php

namespace TaskTags;

function searchOnTagName ($mysqli, $id_users, $keyword, $tag_name,
    $offset, $limit, &$total) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);
    $tag_name = $mysqli->real_escape_string($tag_name);

    $sql = "select count(*) total from task_tags where id_users = $id_users"
        ." and task_text like '%$keyword%' and tag_name = '$tag_name'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from task_tags where id_users = $id_users"
        ." and task_text like '%$keyword%' and tag_name = '$tag_name'"
        .' order by top_priority desc, update_time desc'
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
