<?php

function to_client_json ($file) {
    return [
        'id' => (int)$file->id_files,
        'name' => $file->file_name,
        'size' => (int)$file->file_size,
        'insert_time' => (int)$file->insert_time,
        'rename_time' => (int)$file->rename_time,
    ];
}
