<?php

namespace Users\Places\Points;

function delete ($mysqli, $point, $updateApiKey = null) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/PlacePoints/delete.php";
    \PlacePoints\delete($mysqli, $point->id);

    include_once __DIR__.'/recalculate.php';
    recalculate($mysqli, $point->id_places, $updateApiKey);

}
