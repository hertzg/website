<?php

function check_date ($day, $month, $year, &$errors) {

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

    include_once __DIR__.'/../../fns/date_is_valid.php';
    if (!date_is_valid($day, $month, $year)) {
        $errors[] = 'The date is invalid.';
    }

}
