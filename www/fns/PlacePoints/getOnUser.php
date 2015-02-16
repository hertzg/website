<?php

namespace PlacePoints;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = 'select * from place_points'
        ." where id_users = $id_users and id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
