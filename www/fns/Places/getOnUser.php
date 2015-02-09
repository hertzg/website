<?php

namespace Places;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from places where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $place = mysqli_single_object($mysqli, $sql);
    if ($place && $place->id_users == $id_users) return $place;
}
