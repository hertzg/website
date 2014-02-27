<?php

namespace Files;

function indexInUserFolder ($mysqli, $idusers, $idfolders, $offset = 0) {
    $sql = 'select * from files'
        ." where idusers = $idusers and idfolders = $idfolders"
        .' order by filename';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
