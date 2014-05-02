<?php

function check_schedule_check_day ($mysqli, &$user) {

    include_once __DIR__.'/../../fns/time_today.php';
    $dayToday = time_today() / (60 * 60 * 24);

    if ($user->schedules_check_day < $dayToday) {

        $id_users = $user->id_users;

        include_once __DIR__.'/../../fns/Schedules/countOnDay.php';
        $num_schedules_today = Schedules\countOnDay($mysqli, $id_users, $dayToday);
        $num_schedules_tomorrow = Schedules\countOnDay($mysqli, $id_users, $dayToday + 1);

        include_once __DIR__.'/../../fns/Users/updateSchedules.php';
        Users\updateSchedules($mysqli, $id_users, $num_schedules_today,
            $num_schedules_tomorrow, $dayToday);

        $user->num_schedules_today = $num_schedules_today;
        $user->num_schedules_tomorrow = $num_schedules_tomorrow;

    }

}
