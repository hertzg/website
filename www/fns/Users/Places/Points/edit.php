<?php

namespace Users\Places\Points;

function edit ($mysqli, $point, $latitude,
    $longitude, $altitude, &$changed, $updateApiKey = null) {

    $altitude_null = $point->altitude === null && $altitude === null;
    $altitude_same = $altitude_null ||
        (string)$point->altitude === (string)$altitude;

    if ((string)$point->latitude === (string)$latitude &&
        (string)$point->longitude === (string)$longitude &&
        $altitude_same) return;

    $changed = true;

    include_once __DIR__.'/../../../PlacePoints/edit.php';
    \PlacePoints\edit($mysqli, $point->id,
        $latitude, $longitude, $altitude, $updateApiKey);

    include_once __DIR__.'/recalculate.php';
    recalculate($mysqli, $point->id_places, $updateApiKey);

}
