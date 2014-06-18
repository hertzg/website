<?php

namespace ReceivedFolderSubfolders;

function indexOnFolder ($mysqli, $id_received_folders, $parent_id) {
    $sql = 'select * from received_folder_subfolders'
        ." where id_received_folders = $id_received_folders"
        ." and parent_id = $parent_id";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
