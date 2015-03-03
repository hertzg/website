<?php

namespace HomePage;

function checkTaskDeadlineCheckDay ($mysqli, &$user, $time_today) {

    $fnsDir = __DIR__.'/..';

    if ($user->task_deadlines_check_day == $time_today) return;

    $time_tomorrow = $time_today + 60 * 60 * 24;

    include_once "$fnsDir/Users/Tasks/countOnDeadline.php";
    $today = \Users\Tasks\countOnDeadline($mysqli, $user, $time_today);
    $tomorrow = \Users\Tasks\countOnDeadline($mysqli, $user, $time_tomorrow);

    include_once "$fnsDir/Users/Tasks/Deadlines/setNumbers.php";
    \Users\Tasks\Deadlines\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $time_today);

    $user->num_task_deadlines_today = $today;
    $user->num_task_deadlines_tomorrow = $tomorrow;

}
