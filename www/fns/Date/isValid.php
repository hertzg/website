<?php

namespace Date;

function isValid ($day, $month, $year) {
    $time = mktime(0, 0, 0, $month, $day, $year);
    return
        date('j', $time) == $day &&
        date('n', $time) == $month &&
        date('Y', $time) == $year;
}
