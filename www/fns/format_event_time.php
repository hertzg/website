<?php

function format_event_time ($event) {
    $s = 'On '.date('F j, Y', $event->event_time);
    $start_hour = $event->start_hour;
    if ($start_hour !== null) {
        $s .= ' at '.str_pad($start_hour, 2, '0', STR_PAD_LEFT)
            .':'.str_pad($event->start_minute, 2, '0', STR_PAD_LEFT);
    }
    return $s;
}
