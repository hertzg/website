<?php

namespace ReceivedFolderFiles;

function ensureSums ($mysqli, $receivedFolderFile) {

    if ($receivedFolderFile->hashes_computed) return;

    $id = $receivedFolderFile->id;

    include_once __DIR__.'/File/path.php';
    $path = File\path($receivedFolderFile->id_users, $id);

    include_once __DIR__.'/../file_sums.php';
    file_sums($path, $md5_sum, $sha256_sum);

    $receivedFolderFile->hashes_computed = '1';
    $receivedFolderFile->md5_sum = $md5_sum;
    $receivedFolderFile->sha256_sum = $sha256_sum;

    $sql = 'update received_folder_files set hashes_computed = 1,'
        ." md5_sum = '$md5_sum', sha256_sum = '$sha256_sum' where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
