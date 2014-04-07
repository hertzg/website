<?php

function invalidate_user_birthdays ($mysqli, $id_users, $birthday_time) {
    if ($birthday_time !== null) {

        $timeNow = time();

        include_once __DIR__.'/../../fns/time_today.php';
        $timeToday = time_today();
        $timeTomorrow = $timeToday + 60 * 60 * 24;

        $day = date('j', $birthday_time);
        $month = date('n', $birthday_time);
        $year = date('Y', $timeNow);
        $birthdayTimeThisYear = mktime(0, 0, 0, $month, $day, $year);

        if ($birthdayTimeThisYear == $timeToday ||
            $birthdayTimeThisYear == $timeTomorrow) {

            include_once __DIR__.'/../../fns/Users/invalidateBirthdays.php';
            Users\invalidateBirthdays($mysqli, $id_users);

        }

    }
}
