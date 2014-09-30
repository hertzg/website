<?php

namespace ReceivedFolderSubfolders;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from received_folder_subfolders where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $folder = mysqli_single_object($mysqli, $sql);
    if ($folder && $folder->id_users == $id_users) return $folder;
}
