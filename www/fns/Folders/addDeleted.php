<?php

namespace Folders;

function addDeleted ($mysqli, $id, $id_users,
    $parent_id_folders, $name, $insert_time, $rename_time) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into folders'
        .' (id_folders, id_users, parent_id_folders,'
        .' name, insert_time, rename_time)'
        ." values ($id, $id_users, $parent_id_folders,"
        ." '$name', $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
