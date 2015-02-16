<?php

namespace Places;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $place = get($mysqli, $id);
    if ($place && $place->id_users == $id_users) return $place;
}
