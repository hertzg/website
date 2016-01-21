<?php

namespace Users\Schedules;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_schedules) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Schedules/indexOnUser.php";
    $schedules = \Schedules\indexOnUser($mysqli, $id_users);

    if ($schedules) {
        include_once __DIR__.'/../DeletedItems/addSchedule.php';
        foreach ($schedules as $schedule) {
            \Users\DeletedItems\addSchedule($mysqli, $schedule, $apiKey);
        }
    }

    include_once "$fnsDir/Schedules/deleteOnUser.php";
    \Schedules\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/ScheduleRevisions/setDeletedOnUser.php";
    \ScheduleRevisions\setDeletedOnUser($mysqli, $id_users, true);

    include_once "$fnsDir/ScheduleTags/deleteOnUser.php";
    \ScheduleTags\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/user_time_today.php";
    $schedules_check_day = user_time_today($user);

    $sql = 'update users set num_schedules = 0,'
        .' num_schedules_today = 0, num_schedules_tomorrow = 0,'
        ." schedules_check_day = $schedules_check_day"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
