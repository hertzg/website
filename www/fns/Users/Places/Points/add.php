<?php

namespace Users\Places\Points;

function add ($mysqli, $place, $latitude,
    $longitude, $altitude, $insertApiKey = null) {

    $id_places = $place->id;

    include_once __DIR__.'/../../../PlacePoints/add.php';
    $id = \PlacePoints\add($mysqli, $place->id_users,
        $id_places, $latitude, $longitude, $altitude, $insertApiKey);

    include_once __DIR__.'/recalculate.php';
    recalculate($mysqli, $id_places, $insertApiKey);

    return $id;

}
