<?php

namespace Channels;

function countOnUser ($mysqli, $idusers) {
    $sql = "select count(*) count from channels where idusers = $idusers";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql)->count;
}
