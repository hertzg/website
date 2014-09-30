<?php

namespace Schedules;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from schedules where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $schedule = mysqli_single_object($mysqli, $sql);
    if ($schedule && $schedule->id_users == $id_users) return $schedule;
}
