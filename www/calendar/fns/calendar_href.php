<?php

function calendar_href ($day, $month, $year) {
    include_once __DIR__.'/../../fns/Date/isValid.php';
    if (!Date\isValid($day, $month, $year)) return '..';
    return "../?year=$year&amp;month=$month&amp;day=$day";
}
