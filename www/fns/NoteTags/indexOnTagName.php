<?php

namespace NoteTags;

function indexOnTagName ($mysqli, $idusers, $tagname,
    $offset, $limit, &$total) {

    $tagname = $mysqli->real_escape_string($tagname);

    $sql = 'select count(*) total from notetags'
        ." where idusers = $idusers and tagname = '$tagname'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = 'select * from notetags'
        ." where idusers = $idusers and tagname = '$tagname'"
        ." order by update_time desc limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
