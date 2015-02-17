<?php

namespace Users\Places\Points;

function add ($mysqli, $place, $latitude,
    $longitude, $altitude, $updateApiKey = null) {

    $fnsDir = __DIR__.'/../../..';
    $id = $place->id;
    $id_users = $place->id_users;

    include_once "$fnsDir/PlacePoints/add.php";

    $num_points = $place->num_points;
    if (!$num_points) {
        $num_points++;
        \PlacePoints\add($mysqli, $id_users, $id,
            $place->latitude, $place->longitude, $place->altitude);
    }

    $num_points++;
    \PlacePoints\add($mysqli, $id_users,
        $id, $latitude, $longitude, $altitude);

    include_once "$fnsDir/PlacePoints/indexOnPlace.php";
    $points = \PlacePoints\indexOnPlace($mysqli, $id);

    $averageLatitude = 0;
    $averageLongitude = 0;
    $averageAltitude = 0;
    $num_altitudes = 0;
    foreach ($points as $point) {

        $averageLatitude += $point->latitude;
        $averageLongitude += $point->longitude;

        $altitude = $point->altitude;
        if ($altitude !== null) {
            $averageAltitude += $altitude;
            $num_altitudes++;
        }
    }
    $averageLatitude /= $num_points;
    $averageLongitude /= $num_points;
    if ($num_altitudes === 0) $averageAltitude = null;
    else $averageAltitude /= $num_altitudes;

    include_once "$fnsDir/Places/editPoints.php";
    \Places\editPoints($mysqli, $id, $averageLatitude, $averageLongitude,
        $averageAltitude, $num_points, $updateApiKey);

}
