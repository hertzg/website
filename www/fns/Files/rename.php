<?php

namespace Files;

function rename ($mysqli, $id, $name) {

    include_once __DIR__.'/../detect_media_type.php';
    $media_type = \detect_media_type($name);

    $name = $mysqli->real_escape_string($name);
    $rename_time = time();

    $sql = "update files set name = '$name', media_type = '$media_type',"
        ." rename_time = $rename_time where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
