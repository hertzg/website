<?php

function invalidate_user_schedules ($mysqli, &$user, $schedule_time) {

    $timeNow = time();

    include_once __DIR__.'/time_today.php';
    $timeToday = time_today();
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    $day = date('j', $schedule_time);
    $month = date('n', $schedule_time);
    $year = date('Y', $timeNow);
    $scheduleTimeThisYear = mktime(0, 0, 0, $month, $day, $year);

    if ($scheduleTimeThisYear == $timeToday ||
        $scheduleTimeThisYear == $timeTomorrow) {

        if ($user->schedules_check_day) {
            $user->schedules_check_day = 0;
            include_once __DIR__.'/Users/invalidateSchedules.php';
            Users\invalidateSchedules($mysqli, $user->id_users);
        }

    }

}
