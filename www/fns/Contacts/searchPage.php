<?php

namespace Contacts;

function searchPage ($mysqli, $idusers, $keyword, $offset, $limit, &$total) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $sql = "select count(*) total from contacts where idusers = $idusers"
        ." and (fullname like '%$keyword%' or alias like '%$keyword%')";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * from contacts where idusers = $idusers"
        ." and (fullname like '%$keyword%' or alias like '%$keyword%')"
        ." order by fullname limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
