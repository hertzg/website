<?php

namespace HomePage;

function checkBirthdayCheckDay ($mysqli, &$user) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/user_time_today.php";
    $timeToday = user_time_today($user);

    if ($user->birthdays_check_day == $timeToday) return;

    $timeTomorrow = $timeToday + 60 * 60 * 24;

    $count = function ($time) use ($mysqli, $user) {
        $day = date('j', $time);
        $month = date('n', $time);
        return \Users\Contacts\countBirthdays($mysqli, $user, $day, $month);
    };

    include_once "$fnsDir/Users/Contacts/countBirthdays.php";
    $today = $count($timeToday);
    $tomorrow = $count($timeTomorrow);

    include_once "$fnsDir/Users/Birthdays/setNumbers.php";
    \Users\Birthdays\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $timeToday);

    $user->num_birthdays_today = $today;
    $user->num_birthdays_tomorrow = $tomorrow;

}
