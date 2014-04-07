<?php

function date_is_valid ($day, $month, $year) {
    $time = mktime(0, 0, 0, $month, $day, $year);
    return
        date('d', $time) == $day &&
        date('m', $time) == $month &&
        date('Y', $time) == $year;
}
