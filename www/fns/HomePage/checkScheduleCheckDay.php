<?php

namespace HomePage;

function checkScheduleCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_day.php";
    $day = user_day($user);

    if ($user->schedules_check_day == $day) return;

    include_once "$fnsDir/Users/Schedules/countOnDay.php";
    $today = \Users\Schedules\countOnDay($mysqli, $user, $day);
    $tomorrow = \Users\Schedules\countOnDay($mysqli, $user, $day + 1);

    include_once "$fnsDir/Users/Schedules/setNumbers.php";
    \Users\Schedules\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $day);

    $user->num_schedules_today = $today;
    $user->num_schedules_tomorrow = $tomorrow;

}
