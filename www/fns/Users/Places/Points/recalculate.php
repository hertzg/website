<?php

namespace Users\Places\Points;

function recalculate ($mysqli, $id, $updateApiKey) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/PlacePoints/indexOnPlace.php";
    $points = \PlacePoints\indexOnPlace($mysqli, $id);
    $num_points = count($points);

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
