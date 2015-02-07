<?php

namespace Files;

function editContent ($mysqli, $id, $size) {

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = "update files set size = $size, readable_size = '$readable_size',"
        ." content_revision = content_revision + 1 where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
