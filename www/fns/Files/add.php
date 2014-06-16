<?php

namespace Files;

function add ($mysqli, $id_users, $id_folders, $name, $size) {

    $name = $mysqli->real_escape_string($name);
    $insert_time = $rename_time = time();

    $sql = 'insert into files'
        .' (id_users, id_folders, name,'
        .' size, insert_time, rename_time)'
        ." value ($id_users, $id_folders, '$name',"
        ." $size, $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
