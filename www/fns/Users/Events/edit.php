<?php

namespace Users\Events;

function edit ($mysqli, $user, $event, $text,
    $event_time, &$changed, $updateApiKey = null) {

    if ($event->text === $text &&
        (int)$event->event_time === $event_time) return;

    $changed = true;

    include_once __DIR__.'/../../Events/edit.php';
    \Events\edit($mysqli, $event->id, $event_time, $text, $updateApiKey);

    include_once __DIR__.'/invalidateIfNeeded.php';
    invalidateIfNeeded($mysqli, $user, $event->event_time);
    invalidateIfNeeded($mysqli, $user, $event_time);

}
