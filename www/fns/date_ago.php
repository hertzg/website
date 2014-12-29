<?php

function date_ago ($time) {

    $seconds = time() - $time;

    $minutes = floor($seconds / 60);
    if (!$minutes) return 'just now';
    if ($minutes <= 1) return 'a minute ago';
    if ($minutes == 30) return 'half an hour ago';

    $hours = floor($minutes / 60);
    if (!$hours) return "$minutes minutes ago";
    if ($hours == 1) return 'an hour ago';

    $days = floor($hours / 24);
    if (!$days) return "$hours hours ago";
    if ($days == 1) return "yesterday";

    $months = floor($days / 30);
    if (!$months) return "$days days ago";
    if ($months == 1) return 'a month ago';

    $years = floor($months / 12);
    if (!$years) return "$months months ago";
    if ($years == 1) return 'a year ago';

    return "$years years ago";

}
