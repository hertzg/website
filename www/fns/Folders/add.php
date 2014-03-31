<?php

namespace Folders;

function add ($mysqli, $id_users, $parent_id_folders, $folder_name) {
    $folder_name = $mysqli->real_escape_string($folder_name);
    $insert_time = time();
    $sql = 'insert into folders'
        .' (id_users, parent_id_folders, folder_name, insert_time)'
        ." values ($id_users, $parent_id_folders, '$folder_name', $insert_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
