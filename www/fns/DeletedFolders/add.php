<?php

namespace DeletedFolders;

function add ($mysqli, $id_deleted_items, $id_folders, $parent_id_folders,
    $id_users, $name, $insert_time, $rename_time, $revision) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into deleted_folders'
        .' (id_deleted_items, id_folders, parent_id_folders,'
        .' id_users, name, insert_time, rename_time, revision)'
        ." values ($id_deleted_items, $id_folders, $parent_id_folders,"
        ." $id_users, '$name', $insert_time, $rename_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
