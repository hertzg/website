<?php

namespace Users\DeletedItems;

function purgeContact ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../ContactRevisions/deleteOnContact.php';
    \ContactRevisions\deleteOnContact($mysqli, $data->id);

    $photo_id = $data->photo_id;
    if ($photo_id) {
        include_once __DIR__.'/../../ContactPhotos/delete.php';
        \ContactPhotos\delete($mysqli, $photo_id);
    }

}
