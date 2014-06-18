<?php

namespace ReceivedFolderSubfolders;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = 'select * from received_folder_subfolders'
        ." where id = $id and id_users = $id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
