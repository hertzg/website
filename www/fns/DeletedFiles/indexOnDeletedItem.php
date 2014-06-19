<?php

namespace DeletedFiles;

function indexOnDeletedItem ($mysqli, $id_deleted_items) {
    $sql = 'select * from deleted_files'
        ." where id_deleted_items = $id_deleted_items";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
