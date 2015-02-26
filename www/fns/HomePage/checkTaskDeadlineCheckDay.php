<?php

namespace HomePage;

function checkTaskDeadlineCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    if ($user->task_deadlines_check_day == $timeToday) return;

    $timeTomorrow = $timeToday + 60 * 60 * 24;

    include_once "$fnsDir/Users/Tasks/countOnDeadline.php";
    $today = \Users\Tasks\countOnDeadline($mysqli, $user, $timeToday);
    $tomorrow = \Users\Tasks\countOnDeadline($mysqli, $user, $timeTomorrow);

    include_once "$fnsDir/Users/Tasks/Deadlines/setNumbers.php";
    \Users\Tasks\Deadlines\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $timeToday);

    $user->num_task_deadlines_today = $today;
    $user->num_task_deadlines_tomorrow = $tomorrow;

}
