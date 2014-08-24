<?php

namespace Tasks;

function indexPageOnUser ($mysqli, $id_users, $offset, $limit, &$total) {

    $fromWhere = "from tasks where id_users = $id_users";

    $sql = "select count(*) total $fromWhere";
    include_once __DIR__.'/../mysqli_single_object.php';
    $total = mysqli_single_object($mysqli, $sql)->total;

    $sql = "select * $fromWhere order by top_priority desc, update_time desc"
        ." limit $limit offset $offset";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);

}
