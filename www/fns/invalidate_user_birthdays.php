<?php

function invalidate_user_birthdays ($mysqli, &$user, $birthday_time) {
    if ($birthday_time !== null) {

        $timeNow = time();

        include_once __DIR__.'/time_today.php';
        $timeToday = time_today();
        $timeTomorrow = $timeToday + 60 * 60 * 24;

        $day = date('j', $birthday_time);
        $month = date('n', $birthday_time);
        $year = date('Y', $timeNow);
        $birthdayTimeThisYear = mktime(0, 0, 0, $month, $day, $year);

        if ($birthdayTimeThisYear == $timeToday ||
            $birthdayTimeThisYear == $timeTomorrow) {

            if ($user->birthdays_check_day) {
                $user->birthdays_check_day = 0;
                include_once __DIR__.'/Users/Invalidate/birthdays.php';
                Users\Invalidate\birthdays($mysqli, $user->id_users);
            }

        }

    }
}
