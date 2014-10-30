<?php

namespace HomePage;

function checkScheduleCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_day.php";
    $day = user_day($user);

    if ($user->schedules_check_day == $day) return;

    $id_users = $user->id_users;

    include_once "$fnsDir/Schedules/countOnDay.php";
    $today = \Schedules\countOnDay($mysqli, $id_users, $day);
    $tomorrow = \Schedules\countOnDay($mysqli, $id_users, $day + 1);

    include_once "$fnsDir/Users/Schedules/setNumbers.php";
    \Users\Schedules\setNumbers($mysqli, $id_users, $today, $tomorrow, $day);

    $user->num_schedules_today = $today;
    $user->num_schedules_tomorrow = $tomorrow;

}
