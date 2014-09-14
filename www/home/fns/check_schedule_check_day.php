<?php

function check_schedule_check_day ($mysqli, &$user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/day_today.php";
    $day_today = day_today();

    if ($user->schedules_check_day == $day_today) return;

    $id_users = $user->id_users;

    include_once "$fnsDir/Schedules/countOnDay.php";
    $today = Schedules\countOnDay($mysqli, $id_users, $day_today);
    $tomorrow = Schedules\countOnDay($mysqli, $id_users, $day_today + 1);

    include_once "$fnsDir/Users/Schedules/setNumbers.php";
    Users\Schedules\setNumbers($mysqli,
        $id_users, $today, $tomorrow, $day_today);

    $user->num_schedules_today = $today;
    $user->num_schedules_tomorrow = $tomorrow;

}
