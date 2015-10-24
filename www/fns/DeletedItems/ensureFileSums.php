<?php

namespace DeletedItems;

function ensureFileSums ($mysqli, $deletedItem) {

    $data_json = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../Files/File/path.php';
    $path = \Files\File\path($deletedItem->id_users, $data_json->id);

    include_once __DIR__.'/../file_sums.php';
    file_sums($path, $md5_sum, $sha256_sum);

    $data_json->hashes_computed = '1';
    $data_json->md5_sum = $md5_sum;
    $data_json->sha256_sum = $sha256_sum;
    $data_json = $deletedItem->data_json = json_encode($data_json);

    $data_json = $mysqli->real_escape_string($data_json);

    $sql = 'update deleted_items set'
        ." data_json = '$data_json' where id = $deletedItem->id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
