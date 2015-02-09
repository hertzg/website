<?php

namespace Places;

function search ($mysqli, $id_users, $keyword) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/escape_like.php";
    $keyword = escape_like($keyword);
    $keyword = $mysqli->real_escape_string($keyword);

    $sql = "select * from places where id_users = $id_users"
        ." and name like '%$keyword%' order by update_time desc";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}
