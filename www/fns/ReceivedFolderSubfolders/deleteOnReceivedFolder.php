<?php

namespace ReceivedFolderSubfolders;

function deleteOnReceivedFolder ($mysqli, $id_received_folders) {
    $sql = 'delete from received_folder_subfolders'
        ." where id_received_folders = $id_received_folders";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
