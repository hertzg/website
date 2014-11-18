<?php

function date_in ($time) {
    $seconds = $time - time();
    $minutes = round($seconds / 60);
    if ($minutes <= 1) return 'in a minute';
    $hours = round($minutes / 60);
    if (!$hours) return "in $minutes minutes";
    if ($hours == 1) return 'in an hour';
    $days = round($hours / 24);
    if (!$days) return "in $hours hours";
    if ($days == 1) return "tomorrow";
    $months = round($days / 30);
    if (!$months) return "in $days days";
    if ($months == 1) return 'in a month';
    $years = round($months / 12);
    if (!$years) return "in $months months";
    if ($years == 1) return 'in a year';
    return "in $years years";
}