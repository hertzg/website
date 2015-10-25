<?php

namespace Files;

function commit ($mysqli, $id) {
    $insert_time = $rename_time = time();
    $sql = "update files set committed = 1, insert_time = $insert_time,"
        ." rename_time = $rename_time where id_files = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
