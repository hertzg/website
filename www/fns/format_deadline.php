<?php

function format_deadline ($deadline_time, $time_today) {
    $days = ($deadline_time - $time_today) / (60 * 60 * 24);
    if ($days > 0) {
        if ($days == 1) return 'tomorrow';
        return "in $days days";
    }
    if ($days < 0) {
        if ($days == -1) return 'yesterday';
        return "$days days ago";
    }
    return 'today';
}
