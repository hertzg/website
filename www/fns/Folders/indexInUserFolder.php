<?php

namespace Folders;

function indexInUserFolder ($mysqli, $idusers, $parentidfolders) {
    $sql = 'select * from folders'
        ." where idusers = $idusers and parentidfolders = $parentidfolders"
        .' order by foldername';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
