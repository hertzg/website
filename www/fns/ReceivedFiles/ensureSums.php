<?php

namespace ReceivedFiles;

function ensureSums ($mysqli, $receivedFile) {

    if ($receivedFile->hashes_computed) return;

    $id = $receivedFile->id;

    include_once __DIR__.'/File/path.php';
    $path = File\path($receivedFile->receiver_id_users, $id);

    include_once __DIR__.'/../file_sums.php';
    file_sums($path, $md5_sum, $sha256_sum);

    $receivedFile->md5_sum = $md5_sum;
    $receivedFile->sha256_sum = $sha256_sum;

    $sql = 'update received_files set hashes_computed = 1,'
        ." md5_sum = '$md5_sum', sha256_sum = '$sha256_sum' where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
