<?php

namespace NoteTags;

function indexOnTagName ($mysqli, $id_users, $tag_name,
    $offset, $limit, &$total) {

    $tag_name = $mysqli->real_escape_string($tag_name);

    $fromWhere = "from note_tags where id_users = $id_users"
        ." and tag_name = '$tag_name'";

    $sql = "select count(*) total $fromWhere";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * $fromWhere order by update_time desc"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
