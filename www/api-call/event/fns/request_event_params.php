<?php

function request_event_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Events/request.php";
    list($event_time, $text) = Events\request();

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    return [$event_time, $text];

}
