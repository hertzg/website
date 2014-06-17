<?php

namespace Users\DeletedItems;

function addFile ($mysqli, $file) {
    include_once __DIR__.'/add.php';
    add($mysqli, $file->id_users, 'file', [
        'id' => $file->id_files,
        'id_folders' => $file->id_folders,
        'name' => $file->name,
        'size' => $file->size,
        'insert_time' => $file->insert_time,
        'rename_time' => $file->rename_time,
    ]);
}
