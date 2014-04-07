<?php

function parse_birth_date ($day, $month, $year, &$errors, &$time) {

    if ($day === 0 && $month === 0 && $year === 0) return;

    if ($day === 0) {
        $errors[] = 'Please, enter birth day.';
        return;
    }

    if ($month === 0) {
        $errors[] = 'Please, enter birth month.';
        return;
    }

    if ($year === 0) {
        $errors[] = 'Please, enter birth year.';
        return;
    }

    include_once __DIR__.'/../../fns/date_is_valid.php';
    if (!date_is_valid($day, $month, $year)) {
        $errors[] = 'The birth date is invalid.';
        return;
    }

    $time = mktime(0, 0, 0, $month, $day, $year);

}
