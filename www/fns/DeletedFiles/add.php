<?php

namespace DeletedFiles;

function add ($mysqli, $id_deleted_items, $id_files,
    $id_folders, $id_users, $content_type, $media_type,
    $name, $size, $insert_time, $rename_time, $content_revision) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into deleted_files'
        .' (id_deleted_items, id_files, id_folders,'
        .' id_users, content_type, media_type, name,'
        .' size, insert_time, rename_time, content_revision)'
        ." values ($id_deleted_items, $id_files, $id_folders,"
        ." $id_users, '$content_type', '$media_type', '$name',"
        ." $size, $insert_time, $rename_time, $content_revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
