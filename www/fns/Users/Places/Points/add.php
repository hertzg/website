<?php

namespace Users\Places\Points;

function add ($mysqli, $place, $latitude,
    $longitude, $altitude, $updateApiKey = null) {

    $id_places = $place->id;

    include_once __DIR__.'/../../../PlacePoints/add.php';
    $id = \PlacePoints\add($mysqli, $place->id_users,
        $id_places, $latitude, $longitude, $altitude);

    include_once __DIR__.'/recalculate.php';
    recalculate($mysqli, $id_places, $updateApiKey);

    return $id;

}
