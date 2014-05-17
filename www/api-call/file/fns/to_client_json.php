<?php

function to_client_json ($file) {
    return [
        'id' => (int)$file->id_files,
        'name' => $file->name,
        'size' => (int)$file->size,
        'insert_time' => (int)$file->insert_time,
        'rename_time' => (int)$file->rename_time,
    ];
}
