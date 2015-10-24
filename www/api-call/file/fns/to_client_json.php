<?php

function to_client_json ($mysqli, $file) {

    include_once __DIR__.'/../../../fns/Files/ensureSums.php';
    Files\ensureSums($mysqli, $file);

    return [
        'id' => (int)$file->id_files,
        'name' => $file->name,
        'size' => (int)$file->size,
        'md5_sum' => $file->md5_sum,
        'sha256_sum' => $file->sha256_sum,
        'insert_time' => (int)$file->insert_time,
        'rename_time' => (int)$file->rename_time,
    ];

}
