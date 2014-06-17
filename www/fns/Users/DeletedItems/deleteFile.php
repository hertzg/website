<?php

namespace Users\DeletedItems;

function deleteFile ($deletedItem) {
    $data = json_decode($deletedItem->data_json);
    include_once __DIR__.'/../../Files/File/delete.php';
    \Files\File\delete($deletedItem->id_users, $data->id);
}
