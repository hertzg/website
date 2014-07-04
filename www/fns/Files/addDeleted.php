<?php

namespace Files;

function addDeleted ($mysqli, $id, $id_users, $id_folders,
    $media_type, $name, $size, $insert_time, $rename_time) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into files'
        .' (id_files, id_users, id_folders, media_type,'
        .' name, size, insert_time, rename_time)'
        ." value ($id, $id_users, $id_folders, '$media_type',"
        ." '$name', $size, $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
