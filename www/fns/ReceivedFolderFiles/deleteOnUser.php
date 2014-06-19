<?php

namespace ReceivedFolderFiles;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from received_folder_files where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
