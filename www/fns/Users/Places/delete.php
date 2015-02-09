<?php

namespace Users\Places;

function delete ($mysqli, $place, $apiKey = null) {

    $id = $place->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Places/delete.php";
    \Places\delete($mysqli, $id);

    if ($place->num_tags) {
        include_once "$fnsDir/PlaceTags/deleteOnPlace.php";
        \PlaceTags\deleteOnPlace($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $place->id_users, -1);

    include_once __DIR__.'/../DeletedItems/addPlace.php';
    \Users\DeletedItems\addPlace($mysqli, $place, $apiKey);

}
