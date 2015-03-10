<?php

namespace Places;

function indexNear ($mysqli, $latitude, $longitude, $exclude_id, $limit) {

    $fnsDir = __DIR__.'/..';

    $sql = "select * from places where id != $exclude_id";
    include_once "$fnsDir/mysqli_query_object.php";
    $places = mysqli_query_object($mysqli, $sql);

    if (!$places) return [];

    include_once "$fnsDir/haversine_distance.php";
    foreach ($places as $place) {
        $place->distance = haversine_distance($latitude,
            $longitude, $place->latitude, $place->longitude);
    }

    usort($places, function ($a, $b) {
        return $a->distance > $b->distance ? 1 : -1;
    });

    $places = array_slice($places, 0, $limit);

    return $places;

}
