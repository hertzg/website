<?php

namespace Tasks;

function get ($mysqli, $idusers, $id) {
    $sql = 'select * from tasks'
        ." where idusers = $idusers and idtasks = $id";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_single_object($mysqli, $sql);
}
