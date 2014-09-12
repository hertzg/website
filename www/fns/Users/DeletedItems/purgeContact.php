<?php

namespace Users\DeletedItems;

function purgeContact ($mysqli, $deletedItem) {
    $data = json_decode($deletedItem->data_json);
    $photo_id = $data->photo_id;
    if ($photo_id) {
        include_once __DIR__.'/../../ContactPhotos/delete.php';
        \ContactPhotos\delete($mysqli, $photo_id);
    }
}
