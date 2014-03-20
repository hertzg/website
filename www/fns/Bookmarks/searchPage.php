<?php

namespace Bookmarks;

function searchPage ($mysqli, $idusers, $keyword, $offset, $limit, &$total) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $sql = 'select count(*) total from bookmarks'
        ." where idusers = $idusers and title like '%$keyword%'";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from bookmarks where idusers = $idusers"
        ." and title like '%$keyword%' order by updatetime desc"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
