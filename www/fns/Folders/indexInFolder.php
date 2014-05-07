<?php

namespace Folders;

function indexInFolder ($mysqli, $parent_id_folders) {
    $sql = "select * from folders where parent_id_folders = $parent_id_folders"
        .' order by folder_name';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
