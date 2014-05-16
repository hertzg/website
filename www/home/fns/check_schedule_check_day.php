<?php

function check_schedule_check_day ($mysqli, &$user) {

    include_once __DIR__.'/../../fns/day_today.php';
    $day_today = day_today();

    if ($user->schedules_check_day < $day_today) {

        $id_users = $user->id_users;

        include_once __DIR__.'/../../fns/Schedules/countOnDay.php';
        $num_schedules_today = Schedules\countOnDay(
            $mysqli, $id_users, $day_today);
        $num_schedules_tomorrow = Schedules\countOnDay(
            $mysqli, $id_users, $day_today + 1);

        include_once __DIR__.'/../../fns/Users/Schedules/update.php';
        Users\Schedules\update($mysqli, $id_users, $num_today,
            $num_schedules_tomorrow, $day_today);

        $user->num_schedules_today = $num_today;
        $user->num_schedules_tomorrow = $num_schedules_tomorrow;

    }

}
