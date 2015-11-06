<?php

function parse_deadline ($day, $month,
    $year, $user, &$errors, &$time, &$focus) {

    if ($day === 0 && $month === 0 && $year === 0) return;

    if ($day === 0) {
        $errors[] = 'Please, enter deadline day.';
        if ($focus === null) $focus = 'deadline_day';
        return;
    }

    if ($month === 0) {
        $errors[] = 'Please, enter deadline month.';
        if ($focus === null) $focus = 'deadline_month';
        return;
    }

    if ($year === 0) {
        $errors[] = 'Please, enter deadline year.';
        if ($focus === null) $focus = 'deadline_year';
        return;
    }

    include_once __DIR__.'/../../fns/Date/isValid.php';
    if (!Date\isValid($day, $month, $year)) {
        $errors[] = 'The deadline is invalid.';
        if ($focus === null) $focus = 'deadline_day';
        return;
    }

    $time = mktime(0, 0, 0, $month, $day, $year);

    include_once __DIR__.'/../../fns/user_time_today.php';
    if ($time < user_time_today($user)) {
        $errors[] = 'The deadline is the past.';
        if ($focus === null) $focus = 'deadline_day';
    }

}
