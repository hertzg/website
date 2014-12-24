<?php

namespace Files;

function editContent ($mysqli, $id, $size) {
    $sql = "update files set size = $size,"
        .' content_revision = content_revision + 1'
        ." where id_files = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
