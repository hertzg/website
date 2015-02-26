<?php

namespace HomePage;

function checkEventCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    if ($user->events_check_day == $timeToday) return;

    $timeTomorrow = $timeToday + 60 * 60 * 24;

    include_once "$fnsDir/Users/Events/countOnTime.php";
    $today = \Users\Events\countOnTime($mysqli, $user, $timeToday);
    $tomorrow = \Users\Events\countOnTime($mysqli, $user, $timeTomorrow);

    include_once "$fnsDir/Users/Events/setNumbers.php";
    \Users\Events\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $timeToday);

    $user->num_events_today = $today;
    $user->num_events_tomorrow = $tomorrow;

}
