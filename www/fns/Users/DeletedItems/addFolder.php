<?php

namespace Users\DeletedItems;

function addFolder ($mysqli, $folder, $apiKey) {
    include_once __DIR__.'/add.php';
    return add($mysqli, $folder->id_users, 'folder', [
        'id' => $folder->id_folders,
        'parent_id_folders' => $folder->parent_id_folders,
        'name' => $folder->name,
        'insert_api_key_id' => $folder->insert_api_key_id,
        'insert_time' => $folder->insert_time,
        'rename_api_key_id' => $folder->rename_api_key_id,
        'rename_time' => $folder->rename_time,
        'revision' => $folder->revision,
    ], $apiKey);
}
