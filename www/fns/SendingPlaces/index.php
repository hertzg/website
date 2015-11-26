<?php

namespace SendingPlaces;

function index ($mysqli) {
    $sql = 'select * from sending_places order by insert_time';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
