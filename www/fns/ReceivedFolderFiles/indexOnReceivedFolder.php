<?php

namespace ReceivedFolderFiles;

function indexOnReceivedFolder ($mysqli, $id_received_folders) {
    $sql = 'select * from received_folder_files'
        ." where id_received_folders = $id_received_folders";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
