<?php

namespace Files;

function addDeleted ($mysqli, $id, $id_users, $id_folders, $content_type,
    $media_type, $name, $size, $insert_time, $rename_time, $content_revision) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into files'
        .' (id_files, id_users, id_folders, content_type, media_type,'
        .' name, size, insert_time, rename_time, content_revision)'
        ." value ($id, $id_users, $id_folders, '$content_type', '$media_type',"
        ." '$name', $size, $insert_time, $rename_time, $content_revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
