<?php

namespace Events;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from events where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $event = mysqli_single_object($mysqli, $sql);
    if ($event && $event->id_users == $id_users) return $event;
}
