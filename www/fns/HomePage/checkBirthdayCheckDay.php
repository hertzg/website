<?php

namespace HomePage;

function checkBirthdayCheckDay ($mysqli, &$user, $time_today) {

    $fnsDir = __DIR__.'/..';

    if ($user->birthdays_check_day == $time_today) return;

    $count = function ($time) use ($mysqli, $user) {
        $day = date('j', $time);
        $month = date('n', $time);
        return \Users\Contacts\countBirthdays($mysqli, $user, $day, $month);
    };

    include_once "$fnsDir/Users/Contacts/countBirthdays.php";
    $today = $count($time_today);
    $tomorrow = $count($time_today + 60 * 60 * 24);

    include_once "$fnsDir/Users/Birthdays/setNumbers.php";
    \Users\Birthdays\setNumbers($mysqli,
        $user->id_users, $today, $tomorrow, $time_today);

    $user->num_birthdays_today = $today;
    $user->num_birthdays_tomorrow = $tomorrow;

}
