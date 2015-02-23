<?php

namespace Users\Places\Points;

function edit ($mysqli, $point, $latitude,
    $longitude, $altitude, $updateApiKey = null) {

    include_once __DIR__.'/../../../PlacePoints/edit.php';
    \PlacePoints\edit($mysqli, $point->id,
        $latitude, $longitude, $altitude, $updateApiKey);

    include_once __DIR__.'/recalculate.php';
    recalculate($mysqli, $point->id_places, $updateApiKey);

}
