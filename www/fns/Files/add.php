<?php

namespace Files;

function add ($mysqli, $id_users, $id_folders, $name, $size, $sourcePath) {

    $name = $mysqli->real_escape_string($name);
    $insert_time = $rename_time = time();

    $sql = 'insert into files'
        .' (id_users, id_folders, name,'
        .' size, insert_time, rename_time)'
        ." value ($id_users, $id_folders, '$name',"
        ." $size, $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id = $mysqli->insert_id;

    include_once __DIR__.'/filePath.php';
    $destinationPath = filePath($id_users, $id);

    copy($sourcePath, $destinationPath);

    return $id;

}
