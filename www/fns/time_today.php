<?php

function time_today () {
    $timeNow = time();
    $dayToday = date('j', $timeNow);
    $monthToday = date('n', $timeNow);
    $yearToday = date('Y', $timeNow);
    return mktime(0, 0, 0, $monthToday, $dayToday, $yearToday);
}
