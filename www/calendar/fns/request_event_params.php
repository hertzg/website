<?php

function request_event_params (&$errors) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Events/request.php";
    list($event_time, $start_hour, $start_minute, $text) = Events\request();

    include_once "$fnsDir/request_strings.php";
    list($event_day, $event_month, $event_year) = request_strings(
        'event_day', 'event_month', 'event_year');

    $event_day = abs((int)$event_day);
    $event_month = abs((int)$event_month);
    $event_year = abs((int)$event_year);

    include_once __DIR__.'/parse_event_time.php';
    parse_event_time($event_day, $event_month,
        $event_year, $errors, $event_time);

    if ($text === '') $errors[] = 'Enter text.';

    if ($start_hour === null && $start_minute !== null) {
        $errors[] = 'Enter start hour.';
    }

    return [$event_day, $event_month, $event_year,
        $event_time, $start_hour, $start_minute, $text];

}
