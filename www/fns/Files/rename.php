<?php

namespace Files;

function rename ($mysqli, $id_users, $id, $name) {

    $name = $mysqli->real_escape_string($name);
    $rename_time = time();

    $sql = "update files set name = '$name',"
        ." rename_time = $rename_time"
        ." where id_users = $id_users and id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
