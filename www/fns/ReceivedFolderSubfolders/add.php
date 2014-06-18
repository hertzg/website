<?php

namespace ReceivedFolderSubfolders;

function add ($mysqli, $id_received_folders, $id_users, $parent_id, $name) {
    $name = $mysqli->real_escape_string($name);
    $sql = 'insert into received_folder_subfolders'
        .' (id_received_folders, id_users, parent_id, name)'
        ." values ($id_received_folders, $id_users, $parent_id, '$name')";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}
