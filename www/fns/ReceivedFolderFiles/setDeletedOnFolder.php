<?php

namespace ReceivedFolderFiles;

function setDeletedOnFolder ($mysqli, $id_received_folders, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update received_folder_files set deleted = $deleted"
        ." where id_received_folders = $id_received_folders";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
