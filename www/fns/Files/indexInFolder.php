<?php

namespace Files;

function indexInFolder ($mysqli, $id_folders) {
    $sql = "select * from files where id_folders = $id_folders"
        .' order by name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
