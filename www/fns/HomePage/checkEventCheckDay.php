<?php

namespace HomePage;

function checkEventCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    if ($user->events_check_day == $timeToday) return;

    $timeTomorrow = $timeToday + 60 * 60 * 24;
    $id_users = $user->id_users;

    include_once "$fnsDir/Events/countOnTime.php";
    $today = \Events\countOnTime($mysqli, $id_users, $timeToday);
    $tomorrow = \Events\countOnTime($mysqli, $id_users, $timeTomorrow);

    include_once "$fnsDir/Users/Events/setNumbers.php";
    \Users\Events\setNumbers($mysqli,
        $id_users, $today, $tomorrow, $timeToday);

    $user->num_events_today = $today;
    $user->num_events_tomorrow = $tomorrow;

}
