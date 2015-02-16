<?php

namespace PlacePoints;

function indexOnPlace ($mysqli, $id_places) {
    $sql = 'select * from place_points'
        ." where id_places = $id_places order by insert_time";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
