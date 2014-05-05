<?php

function parse_event_time ($day, $month, $year, &$errors, &$time) {

    if ($day === 0) {
        $errors[] = 'Enter day.';
        return;
    }

    if ($month === 0) {
        $errors[] = 'Enter month.';
        return;
    }

    if ($year === 0) {
        $errors[] = 'Enter year.';
        return;
    }

    include_once __DIR__.'/../../fns/Date/isValid.php';
    if (!Date\isValid($day, $month, $year)) {
        $errors[] = 'The date is invalid.';
    }

    $time = mktime(0, 0, 0, $month, $day, $year);

}
