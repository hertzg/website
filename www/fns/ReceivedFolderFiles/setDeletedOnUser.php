<?php

namespace ReceivedFolderFiles;

function setDeletedOnUser ($mysqli, $id_users) {
    $sql = "update received_folder_files set deleted = 1"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
