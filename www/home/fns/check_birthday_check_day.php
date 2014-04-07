<?php

function check_birthday_check_day ($mysqli, &$user) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();

    if ($user->birthdays_check_day < $timeToday) {

        $timeTomorrow = $timeToday + 60 * 60 * 24;
        $id_users = $user->id_users;

        include_once __DIR__.'/../../fns/Contacts/countBirthdays.php';
        $num_birthdays_today = Contacts\countBirthdays($mysqli, $id_users, $timeToday);
        $num_birthdays_tomorrow = Contacts\countBirthdays($mysqli, $id_users, $timeTomorrow);

        include_once __DIR__.'/../../fns/Users/updateBirthdays.php';
        Users\updateBirthdays($mysqli, $id_users, $num_birthdays_today,
            $num_birthdays_tomorrow, $timeToday);

        $user->num_birthdays_today = $num_birthdays_today;
        $user->num_birthdays_tomorrow = $num_birthdays_tomorrow;

    }

}
