<?php

namespace Notes;

function indexPageOnUser ($mysqli, $id_users, $offset, $limit, &$total) {

    $fnsDir = __DIR__.'/..';

    $fromWhere = "from notes where id_users = $id_users";

    $sql = "select count(*) total $fromWhere";
    include_once "$fnsDir/mysqli_single_object.php";
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * $fromWhere order by update_time desc"
        ." limit $limit offset $offset";
    include_once "$fnsDir/mysqli_query_object.php";
    return mysqli_query_object($mysqli, $sql);

}

