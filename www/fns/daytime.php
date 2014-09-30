<?php

function daytime ($time) {
    $day = date('j', $time);
    $month = date('n', $time);
    $year = date('Y', $time);
    return mktime(0, 0, 0, $month, $day, $year);
}
