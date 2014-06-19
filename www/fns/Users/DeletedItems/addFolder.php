<?php

namespace Users\DeletedItems;

function addFolder ($mysqli, $folder) {
    include_once __DIR__.'/add.php';
    return add($mysqli, $folder->id_users, 'folder', [
        'id' => $folder->id_folders,
        'name' => $folder->name,
        'insert_time' => $folder->insert_time,
        'rename_time' => $folder->rename_time,
    ]);
}
