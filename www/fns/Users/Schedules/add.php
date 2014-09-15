<?php

namespace Users\Schedules;

function add ($mysqli, $user, $text, $interval, $offset) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/add.php";
    $id = \Schedules\add($mysqli, $id_users, $text, $interval, $offset);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($interval, $offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);

    return $id;

}
