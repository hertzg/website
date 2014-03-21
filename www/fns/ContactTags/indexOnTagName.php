<?php

namespace ContactTags;

function indexOnTagName ($mysqli, $idusers, $tagname,
    $offset, $limit, &$total) {

    $tagname = $mysqli->real_escape_string($tagname);

    $sql = 'select count(*) total from contact_tags'
        ." where idusers = $idusers and tagname = '$tagname'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from contact_tags where idusers = $idusers"
        ." and tagname = '$tagname' order by full_name"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
