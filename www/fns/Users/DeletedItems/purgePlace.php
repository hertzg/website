<?php

namespace Users\DeletedItems;

function purgePlace ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../PlacePoints/deleteOnPlace.php';
    \PlacePoints\deleteOnPlace($mysqli, $data->id);

}
