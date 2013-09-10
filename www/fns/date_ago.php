<?php

function date_ago ($time) {
    $seconds = time() - $time;
    $minutes = round($seconds / 60);
    if ($minutes <= 1) return 'a minute ago';
    $hours = round($minutes / 60);
    if (!$hours) return "$minutes minutes ago";
    if ($hours == 1) return 'an hour ago';
    $days = round($hours / 24);
    if (!$days) return "$hours hours ago";
    if ($days == 1) return "yesterday";
    $months = round($days / 30);
    if (!$months) return "$days days ago";
    if ($months == 1) return 'a month ago';
    $years = round($months / 12);
    if (!$years) return "$months months ago";
    if ($years == 1) return 'a year ago';
    return "$years years ago";
}
