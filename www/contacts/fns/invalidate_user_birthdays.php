<?php

function invalidate_user_birthdays ($mysqli, $id_users, $birthday_time) {

    include_once __DIR__.'/../../fns/time_today.php';
    $timeToday = time_today();
    $timeTomorrow = $timeToday + 60 * 60 * 24;

    if ($birthday_time == $timeToday || $birthday_time == $timeTomorrow) {
        include_once __DIR__.'/../../fns/Users/invalidateBirthdays.php';
        Users\invalidateBirthdays($mysqli, $id_users);
    }

}
