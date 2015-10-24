<?php

namespace DeletedFiles;

function ensureSums ($mysqli, $deletedFile) {

    if ($deletedFile->hashes_computed) return;

    $id = $deletedFile->id_files;

    include_once __DIR__.'/../Files/File/path.php';
    $path = \Files\File\path($deletedFile->id_users, $id);

    include_once __DIR__.'/../file_sums.php';
    file_sums($path, $md5_sum, $sha256_sum);

    $deletedFile->md5_sum = $md5_sum;
    $deletedFile->sha256_sum = $sha256_sum;

    $sql = 'update deleted_files set hashes_computed = 1,'
        ." md5_sum = '$md5_sum', sha256_sum = '$sha256_sum'"
        ." where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
