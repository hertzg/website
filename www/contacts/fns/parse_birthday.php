<?php

function parse_birthday ($day, $month,
    $year, $user, &$errors, &$time, &$focus) {

    if ($day === 0 && $month === 0 && $year === 0) return;

    if ($day === 0) {
        $errors[] = 'Please, enter birth day.';
        if ($focus === null) $focus = 'birthday_day';
        return;
    }

    if ($month === 0) {
        $errors[] = 'Please, enter birth month.';
        if ($focus === null) $focus = 'birthday_month';
        return;
    }

    if ($year === 0) {
        $errors[] = 'Please, enter birth year.';
        if ($focus === null) $focus = 'birthday_year';
        return;
    }

    include_once __DIR__.'/../../fns/Date/isValid.php';
    if (!Date\isValid($day, $month, $year)) {
        $errors[] = 'The birth date is invalid.';
        if ($focus === null) $focus = 'birthday_day';
        return;
    }

    $time = mktime(0, 0, 0, $month, $day, $year);

    include_once __DIR__.'/../../fns/user_time_today.php';
    if ($time > user_time_today($user)) {
        $errors[] = 'The birth date is in the future.';
        if ($focus === null) $focus = 'birthday_day';
    }

}
