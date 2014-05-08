<?php

namespace Files;

function add ($mysqli, $id_users, $id_folders, $file_name, $file_size, $sourcePath) {

    $file_name = $mysqli->real_escape_string($file_name);
    $insert_time = time();

    $sql = 'insert into files'
        .' (id_users, id_folders, file_name,'
        .' file_size, insert_time)'
        ." value ($id_users, $id_folders, '$file_name',"
        ." $file_size, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id = $mysqli->insert_id;

    include_once __DIR__.'/filePath.php';
    $destinationPath = filePath($id_users, $id);

    rename($sourcePath, $destinationPath);

}
