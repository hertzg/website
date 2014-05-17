<?php

namespace Folders;

function add ($mysqli, $id_users, $parent_id_folders, $name) {

    $name = $mysqli->real_escape_string($name);
    $insert_time = $rename_time = time();

    $sql = 'insert into folders'
        .' (id_users, parent_id_folders,'
        .' name, insert_time, rename_time)'
        ." values ($id_users, $parent_id_folders,"
        ." '$name', $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
