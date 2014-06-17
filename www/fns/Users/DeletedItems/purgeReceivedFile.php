<?php

namespace Users\DeletedItems;

function purgeReceivedFile ($deletedItem) {
    $data = json_decode($deletedItem->data_json);
    include_once __DIR__.'/../../ReceivedFiles/File/delete.php';
    \ReceivedFiles\File\delete($deletedItem->id_users, $data->id);
}
