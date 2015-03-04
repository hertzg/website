<?php

namespace Folders;

function indexInFolder ($mysqli, $parent_id) {
    $sql = 'select * from folders'
        ." where parent_id = $parent_id order by name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
