<?php

function check_task_deadline_check_day ($mysqli, &$user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    if ($user->task_deadlines_check_day == $timeToday) return;

    $timeTomorrow = $timeToday + 60 * 60 * 24;
    $id_users = $user->id_users;

    include_once "$fnsDir/Tasks/countOnUserAndDeadline.php";
    $today = Tasks\countOnUserAndDeadline($mysqli, $id_users, $timeToday);
    $tomorrow = Tasks\countOnUserAndDeadline($mysqli, $id_users, $timeTomorrow);

    include_once "$fnsDir/Users/TaskDeadlines/setNumbers.php";
    Users\TaskDeadlines\setNumbers($mysqli,
        $id_users, $today, $tomorrow, $timeToday);

    $user->num_task_deadlines_today = $today;
    $user->num_task_deadlines_tomorrow = $tomorrow;

}
