<?php

namespace Contacts;

function search ($mysqli, $id_users, $keyword) {

    include_once __DIR__.'/../escape_like.php';
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $sql = "select * from contacts where id_users = $id_users"
        ." and (full_name like '%$keyword%' or alias like '%$keyword%')"
        .' order by favorite desc, full_name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
