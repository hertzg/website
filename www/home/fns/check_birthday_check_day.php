<?php

function check_birthday_check_day ($mysqli, &$user) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();

    if ($user->birthdays_check_day < $timeToday) {

        $timeTomorrow = $timeToday + 60 * 60 * 24;
        $id_users = $user->id_users;

        $count = function ($time) use ($mysqli, $id_users) {
            $day = date('j', $time);
            $month = date('n', $time);
            return Contacts\countBirthdays($mysqli, $id_users, $day, $month);
        };

        include_once __DIR__.'/../../fns/Contacts/countBirthdays.php';
        $num_birthdays_today = $count($timeToday);
        $num_birthdays_tomorrow = $count($timeTomorrow);

        include_once __DIR__.'/../../fns/Users/updateBirthdays.php';
        Users\updateBirthdays($mysqli, $id_users, $num_birthdays_today,
            $num_birthdays_tomorrow, $timeToday);

        $user->num_birthdays_today = $num_birthdays_today;
        $user->num_birthdays_tomorrow = $num_birthdays_tomorrow;

    }

}
