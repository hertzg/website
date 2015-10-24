<?php

namespace Users\DeletedItems;

function addFile ($mysqli, $file, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $file->id_users, 'file', [
        'id' => $file->id_files,
        'id_folders' => $file->id_folders,
        'content_type' => $file->content_type,
        'media_type' => $file->media_type,
        'name' => $file->name,
        'size' => $file->size,
        'readable_size' => $file->readable_size,
        'hashes_computed' => $file->hashes_computed,
        'md5_sum' => $file->md5_sum,
        'sha256_sum' => $file->sha256_sum,
        'insert_api_key_id' => $file->insert_api_key_id,
        'insert_time' => $file->insert_time,
        'rename_api_key_id' => $file->rename_api_key_id,
        'rename_time' => $file->rename_time,
        'content_revision' => $file->content_revision,
        'revision' => $file->revision,
    ], $apiKey);
}
