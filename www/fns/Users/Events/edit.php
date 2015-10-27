<?php

namespace Users\Events;

function edit ($mysqli, $user, $event, $text, $event_time,
    $start_hour, $start_minute, &$changed, $updateApiKey = null) {

    if ($event->text === $text && (int)$event->event_time === $event_time) {
        if (($event->start_hour === null && $start_hour === null) ||
            (int)$event->start_hour === $start_hour) {

            if (($event->start_minute === null && $start_minute === null) ||
                (int)$event->start_minute === $start_minute) return;

        }
    }

    $changed = true;

    include_once __DIR__.'/../../Events/edit.php';
    \Events\edit($mysqli, $event->id, $event_time,
        $start_hour, $start_minute, $text, $updateApiKey);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event->event_time);
    invalidateIfNeeded($mysqli, $user, $event_time);

}
