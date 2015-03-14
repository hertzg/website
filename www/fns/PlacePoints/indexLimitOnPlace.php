<?php

namespace PlacePoints;

function indexLimitOnPlace ($mysqli, $id_places, $limit) {
    $sql = "select * from place_points where id_places = $id_places"
        ." order by insert_time desc limit $limit";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
