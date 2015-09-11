<?php

namespace Files;

function editContent ($mysqli, $id, $size, $md5_sum, $sha256_sum) {

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = "update files set size = $size, readable_size = '$readable_size',"
        ." md5_sum = '$md5_sum', sha256_sum = '$sha256_sum',"
        ." content_revision = content_revision + 1 where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
