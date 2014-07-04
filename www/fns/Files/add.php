<?php

namespace Files;

function add ($mysqli, $id_users, $id_folders, $name, $size) {

    include_once __DIR__.'/../detect_media_type.php';
    $media_type = \detect_media_type($name);

    $name = $mysqli->real_escape_string($name);
    $insert_time = $rename_time = time();

    $sql = 'insert into files'
        .' (id_users, id_folders, media_type, name,'
        .' size, insert_time, rename_time)'
        ." value ($id_users, $id_folders, '$media_type', '$name',"
        ." $size, $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
