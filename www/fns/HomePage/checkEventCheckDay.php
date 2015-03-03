<?php

namespace HomePage;

function checkEventCheckDay ($mysqli, &$user, $time_today) {

    $fnsDir = __DIR__.'/..';

    if ($user->events_check_day == $time_today) return;

    $time_tomorrow = $time_today + 60 * 60 * 24;

    include_once "$fnsDir/Users/Events/countOnTime.php";
    $today = \Users\Events\countOnTime($mysqli, $user, $time_today);
    $tomorrow = \Users\Events\countOnTime($mysqli, $user, $time_tomorrow);

    include_once "$fnsDir/Users/Events/setNumbers.php";
    \Users\Events\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $time_today);

    $user->num_events_today = $today;
    $user->num_events_tomorrow = $tomorrow;

}
