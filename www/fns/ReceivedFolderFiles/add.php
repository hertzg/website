<?php

namespace ReceivedFolderFiles;

function add ($mysqli, $id_received_folders,
    $id_users, $parent_id, $name, $size) {

    $name = $mysqli->real_escape_string($name);
    $sql = 'insert into received_folder_files'
        .' (id_received_folders, id_users,'
        .' parent_id, name, size)'
        ." values ($id_received_folders, $id_users,"
        ." $parent_id, '$name', $size)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;

}
