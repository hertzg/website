<?php

namespace Users\Places\Points;

function deleteAll ($mysqli, $place, $apiKey = null) {

    $id = $place->id;
    $latitude = $place->latitude;
    $longitude = $place->longitude;
    $altitude = $place->altitude;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/PlacePoints/deleteOnPlace.php";
    \PlacePoints\deleteOnPlace($mysqli, $id);

    include_once "$fnsDir/PlacePoints/add.php";
    \PlacePoints\add($mysqli, $place->id_users, $id,
        $latitude, $longitude, $altitude, $apiKey);

    include_once "$fnsDir/Places/editPoints.php";
    \Places\editPoints($mysqli, $id, $latitude,
        $longitude, $altitude, 1, $apiKey);

}
