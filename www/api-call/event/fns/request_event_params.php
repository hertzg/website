<?php

function request_event_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Events/request.php";
    list($event_time, $start_hour, $start_minute, $text) = Events\request();

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    if ($start_hour === null) $start_minute = null;

    return [$event_time, $start_hour, $start_minute, $text];

}
