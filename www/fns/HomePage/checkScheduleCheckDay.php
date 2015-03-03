<?php

namespace HomePage;

function checkScheduleCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    if ($user->schedules_check_day == $time_today) return;

    $time_tomorrow = $time_today + 60 * 60 * 24;

    include_once "$fnsDir/Users/Schedules/countOnDay.php";
    $today = \Users\Schedules\countOnDay($mysqli, $user, $time_today);
    $tomorrow = \Users\Schedules\countOnDay($mysqli, $user, $time_tomorrow);

    include_once "$fnsDir/Users/Schedules/setNumbers.php";
    \Users\Schedules\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $time_today);

    $user->num_schedules_today = $today;
    $user->num_schedules_tomorrow = $tomorrow;

}
