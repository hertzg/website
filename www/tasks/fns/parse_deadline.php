<?php

function parse_deadline ($day, $month, $year, &$errors, &$time) {

    if ($day === 0 && $month === 0 && $year === 0) return;

    if ($day === 0) {
        $errors[] = 'Please, enter deadline day.';
        return;
    }

    if ($month === 0) {
        $errors[] = 'Please, enter deadline month.';
        return;
    }

    if ($year === 0) {
        $errors[] = 'Please, enter deadline year.';
        return;
    }

    include_once __DIR__.'/../../fns/Date/isValid.php';
    if (!Date\isValid($day, $month, $year)) {
        $errors[] = 'The deadline is invalid.';
        return;
    }

    $time = mktime(0, 0, 0, $month, $day, $year);

}
