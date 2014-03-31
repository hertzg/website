<?php

namespace Files;

function add ($mysqli, $id_users, $id_folders, $file_name, $filepath) {

    $file_name = $mysqli->real_escape_string($file_name);
    $file_size = filesize($filepath);
    $insert_time = time();

    $sql = 'insert into files'
        .' (id_users, id_folders, file_name,'
        .' file_size, insert_time)'
        ." value ($id_users, $id_folders, '$file_name',"
        ." $file_size, $insert_time)";

    $mysqli->query($sql);

    $id = $mysqli->insert_id;

    include_once __DIR__.'/filename.php';
    $filename = filename($id_users, $id);

    rename($filepath, $filename);

    include_once __DIR__.'/../Users/addStorageUsed.php';
    \Users\addStorageUsed($mysqli, $id_users, $file_size);

}
