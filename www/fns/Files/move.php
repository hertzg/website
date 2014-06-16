<?php

namespace Files;

function move ($mysqli, $id, $id_folders) {
    $sql = "update files set id_folders = $id_folders where id_files = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
