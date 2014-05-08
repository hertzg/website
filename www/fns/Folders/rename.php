<?php

namespace Folders;

function rename ($mysqli, $id_users, $id_folders, $folder_name) {
    $folder_name = $mysqli->real_escape_string($folder_name);
    $sql = "update folders set folder_name = '$folder_name'"
        ." where id_users = $id_users and id_folders = $id_folders";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
