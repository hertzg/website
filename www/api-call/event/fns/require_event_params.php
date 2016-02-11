<?php

function require_event_params (&$event_time,
    &$start_hour, &$start_minute, &$text) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Events/request.php";
    list($event_time, $start_hour, $start_minute, $text) = Events\request();

    if ($text === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_TEXT"');
    }

    if ($start_hour === null) $start_minute = null;

}
