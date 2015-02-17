<?php

namespace Users\Places\Points;

function add ($mysqli, $place, $latitude,
    $longitude, $altitude, $updateApiKey = null) {

    $id = $place->id;

    include_once __DIR__.'/../../../PlacePoints/add.php';
    \PlacePoints\add($mysqli, $place->id_users,
        $id, $latitude, $longitude, $altitude);

    include_once __DIR__.'/recalculate.php';
    recalculate($mysqli, $id, $updateApiKey);

}
