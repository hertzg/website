<?php

function haversine_distance ($latitude1, $longitude1, $latitude2, $longitude2) {

    $latitude1 = deg2rad($latitude1);
    $longitude1 = deg2rad($longitude1);
    $latitude2 = deg2rad($latitude2);
    $longitude2 = deg2rad($longitude2);

    $delta_latitude = $latitude2 - $latitude1;
    $delta_longitude = $longitude2 - $longitude1;

    $angle = 2 * asin(sqrt(pow(sin($delta_latitude / 2), 2) +
        cos($latitude1) * cos($latitude2) * pow(sin($delta_longitude / 2), 2)));

    return $angle * 6371000;

}
