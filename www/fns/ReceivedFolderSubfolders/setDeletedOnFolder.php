<?php

namespace ReceivedFolderSubfolders;

function setDeletedOnFolder ($mysqli, $id_received_folders, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update received_folder_subfolders set deleted = $deleted"
        ." where id_received_folders = $id_received_folders";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
