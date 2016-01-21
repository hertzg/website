<?php

namespace Users\Schedules;

function delete ($mysqli, $user, $schedule, $apiKey = null) {

    $id = $schedule->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/delete.php";
    \Schedules\delete($mysqli, $id);

    include_once "$fnsDir/ScheduleRevisions/setDeletedOnSchedule.php";
    \ScheduleRevisions\setDeletedOnSchedule($mysqli, $id, true);

    if ($schedule->num_tags) {
        include_once "$fnsDir/ScheduleTags/deleteOnSchedule.php";
        \ScheduleTags\deleteOnSchedule($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $user->id_users, -1);

    include_once "$fnsDir/days_left_from_today.php";
    $days_left = days_left_from_today($user,
        $schedule->interval, $schedule->offset);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $days_left);

    include_once __DIR__.'/../DeletedItems/addSchedule.php';
    \Users\DeletedItems\addSchedule($mysqli, $schedule, $apiKey);

}
