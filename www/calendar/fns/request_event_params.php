<?php

function request_event_params (&$errors) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($event_day, $event_month, $event_year) = request_strings(
        'event_day', 'event_month', 'event_year');

    $event_day = abs((int)$event_day);
    $event_month = abs((int)$event_month);
    $event_year = abs((int)$event_year);

    include_once __DIR__.'/parse_event_time.php';
    parse_event_time($event_day, $event_month,
        $event_year, $errors, $event_time);

    include_once "$fnsDir/Events/request.php";
    list($event_time, $text) = Events\request();

    if ($text === '') $errors[] = 'Enter text.';

    return [$event_day, $event_month, $event_year, $event_time, $text];

}
