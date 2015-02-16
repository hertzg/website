<?php

namespace PlacePoints;

function countOnPlace ($mysqli, $id_places) {
    $sql = 'select count(*) value from place_points'
        ." where id_places = $id_places";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->value;
}
