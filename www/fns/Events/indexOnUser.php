<?php

namespace Events;

function indexOnUser ($mysqli, $idusers) {
    $sql = "select * from events where idusers = $idusers order by eventtime";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
