<?php

function date_in ($time) {

    $seconds = $time - time();

    $minutes = floor($seconds / 60);
    if (!$minutes) return 'right now';
    if ($minutes <= 1) return 'in a minute';
    if ($minutes == 30) return 'in half an hour';

    $hours = floor($minutes / 60);
    if (!$hours) return "in $minutes minutes";
    if ($hours == 1) return 'in an hour';

    $days = floor($hours / 24);
    if (!$days) return "in $hours hours";
    if ($days == 1) return "tomorrow";

    $months = floor($days / 30);
    if (!$months) return "in $days days";
    if ($months == 1) return 'in a month';

    $years = floor($months / 12);
    if (!$years) return "in $months months";
    if ($years == 1) return 'in a year';

    return "in $years years";

}
