<?php

namespace Users\Birthdays;

function invalidateIfNeeded ($mysqli, &$user, $birthday_time) {

    if ($birthday_time === null) return;

    include_once __DIR__.'/../../user_time_today.php';
    $timeToday = user_time_today($user);
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    $day = date('j', $birthday_time);
    $month = date('n', $birthday_time);
    $year = date('Y', $timeToday);
    $birthdayTimeThisYear = mktime(0, 0, 0, $month, $day, $year);

    if ($birthdayTimeThisYear == $timeToday ||
        $birthdayTimeThisYear == $timeTomorrow) {

        if ($user->birthdays_check_day) {
            $user->birthdays_check_day = 0;
            include_once __DIR__.'/invalidate.php';
            invalidate($mysqli, $user->id_users);
        }

    }

}
