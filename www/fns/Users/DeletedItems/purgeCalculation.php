<?php

namespace Users\DeletedItems;

function purgeCalculation ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../ReferencedCalculations/deleteOnCalculation.php';
    \ReferencedCalculations\deleteOnCalculation($mysqli, $data->id);

}
