<?php

namespace DeletedFolders;

function add ($mysqli, $id_deleted_items, $id_folders,
    $parent_id_folders, $id_users, $name, $insert_time, $rename_time) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into deleted_folders'
        .' (id_deleted_items, id_folders, parent_id_folders,'
        .' id_users, name, insert_time, rename_time)'
        ." values ($id_deleted_items, $id_folders, $parent_id_folders,"
        ." $id_users, '$name', $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
