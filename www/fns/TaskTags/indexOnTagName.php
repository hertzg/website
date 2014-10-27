<?php

namespace TaskTags;

function indexOnTagName ($mysqli, $id_users,
    $tag_name, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $tag_name = $mysqli->real_escape_string($tag_name);

    $fromWhere = "from task_tags where id_users = $id_users"
        ." and tag_name = '$tag_name'";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    if ($offset >= $total) return [];

    $sql = "select *, id_tasks id $fromWhere"
        .' order by top_priority desc, update_time desc'
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
