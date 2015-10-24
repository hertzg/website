<?php

namespace Files;

function ensureSums ($mysqli, $file) {

    if ($file->hashes_computed) return;

    $id = $file->id_files;

    include_once __DIR__.'/File/path.php';
    $path = File\path($file->id_users, $id);

    include_once __DIR__.'/../file_sums.php';
    file_sums($path, $md5_sum, $sha256_sum);

    $file->md5_sum = $md5_sum;
    $file->sha256_sum = $sha256_sum;

    $sql = 'update files set hashes_computed = 1,'
        ." md5_sum = '$md5_sum', sha256_sum = '$sha256_sum'"
        ." where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
