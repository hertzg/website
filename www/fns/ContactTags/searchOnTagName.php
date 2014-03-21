<?php

namespace ContactTags;

function searchOnTagName ($mysqli, $idusers, $keyword, $tagname,
    $offset, $limit, &$total) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);
    $tagname = $mysqli->real_escape_string($tagname);

    $sql = "select count(*) total from contact_tags where idusers = $idusers"
        ." and (full_name like '%$keyword%' or alias like '%$keyword%')"
        ." and tagname = '$tagname'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from contact_tags where idusers = $idusers"
        ." and (full_name like '%$keyword%' or alias like '%$keyword%')"
        ." and tagname = '$tagname' order by full_name"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
