<?php

namespace ReceivedFolderFiles;

function add ($mysqli, $id_received_folders,
    $id_users, $parent_id, $name, $size) {

    include_once __DIR__.'/../detect_media_type.php';
    $media_type = \detect_media_type($name);

    $name = $mysqli->real_escape_string($name);
    $sql = 'insert into received_folder_files'
        .' (id_received_folders, id_users,'
        .' parent_id, media_type, name, size)'
        ." values ($id_received_folders, $id_users,"
        ." $parent_id, '$media_type', '$name', $size)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;

}
