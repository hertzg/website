<?php

namespace Places;

function updateNumbers ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/mysqli_query_object.php";
    $places = mysqli_query_object($mysqli, 'select * from places');

    if (!$places) return;

    include_once __DIR__.'/editNumbers.php';
    include_once "$fnsDir/PlacePoints/countOnPlace.php";
    foreach ($places as $place) {
        $id = $place->id;
        $num_points = \PlacePoints\countOnPlace($mysqli, $id);
        editNumbers($mysqli, $id, $num_points);
    }

}
