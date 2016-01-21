<?php

namespace Users\Schedules;

function add ($mysqli, $user, $text, $interval,
    $offset, $tags, $tag_names, $insertApiKey = null) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    $insert_time = $update_time = time();

    include_once "$fnsDir/Schedules/add.php";
    $id = \Schedules\add($mysqli, $id_users,
        $text, $interval, $offset, $tags, $tag_names,
        $insert_time, $update_time, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/ScheduleTags/add.php";
        \ScheduleTags\add($mysqli, $id_users, $id, $tag_names,
            $text, $interval, $offset, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once "$fnsDir/ScheduleRevisions/add.php";
    \ScheduleRevisions\add($mysqli, $id, $id_users,
        $text, $interval, $offset, $tags, $insert_time, 0);

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user, $interval, $offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);

    return $id;

}
