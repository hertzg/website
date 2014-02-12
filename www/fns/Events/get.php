<?php

namespace Events;

function get ($mysqli, $idusers, $id) {
    $sql = 'select * from events'
        ." where idusers = $idusers and idevents = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
