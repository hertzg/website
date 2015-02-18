<?php

namespace Users\Places;

function edit ($mysqli, $place, $latitude, $longitude,
    $altitude, $name, $tags, $tag_names, $updateApiKey = null) {

    $id = $place->id;
    $fnsDir = __DIR__.'/../..';

    if ($latitude !== (float)$place->latitude ||
        $longitude !== (float)$place->longitude ||
        $altitude !== (float)$place->altitude) {

        include_once "$fnsDir/PlacePoints/deleteOnPlace.php";
        \PlacePoints\deleteOnPlace($mysqli, $id);

        include_once "$fnsDir/PlacePoints/add.php";
        \PlacePoints\add($mysqli, $place->id_users,
            $id, $latitude, $longitude, $altitude);

        $num_points = 1;

    } else {
        $num_points = $place->num_points;
    }

    include_once "$fnsDir/Places/edit.php";
    \Places\edit($mysqli, $id, $latitude, $longitude,
        $altitude, $name, $tags, $tag_names, $num_points, $updateApiKey);

    if ($place->num_tags) {
        include_once "$fnsDir/PlaceTags/deleteOnPlace.php";
        \PlaceTags\deleteOnPlace($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/PlaceTags/add.php";
        \PlaceTags\add($mysqli, $place->id_users, $id,
            $tag_names, $latitude, $longitude, $name, $tags);
    }

}
