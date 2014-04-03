<?php

namespace ContactTags;

function searchOnTagName ($mysqli, $id_users, $keyword, $tag_name,
    $offset, $limit, &$total) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);
    $tag_name = $mysqli->real_escape_string($tag_name);

    $sql = "select count(*) total from contact_tags where id_users = $id_users"
        ." and (full_name like '%$keyword%' or alias like '%$keyword%')"
        ." and tag_name = '$tag_name'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from contact_tags where id_users = $id_users"
        ." and (full_name like '%$keyword%' or alias like '%$keyword%')"
        ." and tag_name = '$tag_name' order by favorite desc, full_name"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
