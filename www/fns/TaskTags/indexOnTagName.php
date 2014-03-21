<?php

namespace TaskTags;

function indexOnTagName ($mysqli, $idusers, $tagname,
    $offset, $limit, &$total) {

    $tagname = $mysqli->real_escape_string($tagname);

    $sql = 'select count(*) total from task_tags'
        ." where idusers = $idusers and tagname = '$tagname'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = 'select * from task_tags'
        ." where idusers = $idusers and tagname = '$tagname'"
        .' order by top_priority desc, update_time desc'
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
