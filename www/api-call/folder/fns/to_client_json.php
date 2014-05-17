<?php

function to_client_json ($folder) {
    return [
        'id' => (int)$folder->id_folders,
        'name' => $folder->name,
        'insert_time' => (int)$folder->insert_time,
        'rename_time' => (int)$folder->rename_time,
    ];
}
