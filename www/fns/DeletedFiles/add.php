<?php

namespace DeletedFiles;

function add ($mysqli, $id_deleted_items, $id_files,
    $id_folders, $id_users, $media_type, $content_type,
    $name, $size, $insert_time, $rename_time) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into deleted_files'
        .' (id_deleted_items, id_files, id_folders,'
        .' id_users, media_type, content_type, name,'
        .' size, insert_time, rename_time)'
        ." values ($id_deleted_items, $id_files, $id_folders,"
        ." $id_users, '$media_type', '$content_type', '$name',"
        ." $size, $insert_time, $rename_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
