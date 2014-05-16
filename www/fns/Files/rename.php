<?php

namespace Files;

function rename ($mysqli, $id_users, $id, $file_name) {

    $file_name = $mysqli->real_escape_string($file_name);
    $rename_time = time();

    $sql = "update files set file_name = '$file_name',"
        ." rename_time = $rename_time"
        ." where id_users = $id_users and id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
