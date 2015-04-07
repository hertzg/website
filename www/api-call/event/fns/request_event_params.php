<?php

function request_event_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Events/request.php";
    list($event_time, $text) = Events\request();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    return [$event_time, $text];

}
