<?php

namespace ContactTags;

function indexOnTagName ($mysqli, $id_users, $tag_name,
    $offset, $limit, &$total) {

    $tag_name = $mysqli->real_escape_string($tag_name);

    $sql = 'select count(*) total from contact_tags'
        ." where id_users = $id_users and tag_name = '$tag_name'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from contact_tags where id_users = $id_users"
        ." and tag_name = '$tag_name' order by favorite desc, full_name"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
