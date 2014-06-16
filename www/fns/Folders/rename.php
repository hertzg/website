<?php

namespace Folders;

function rename ($mysqli, $id, $name) {

    $name = $mysqli->real_escape_string($name);
    $rename_time = time();

    $sql = "update folders set name = '$name', rename_time = $rename_time"
        ." where id_folders = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
