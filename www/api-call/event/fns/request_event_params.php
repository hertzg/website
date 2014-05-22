<?php

function request_event_params () {

    include_once __DIR__.'/../../../fns/Events/request.php';
    $text = Events\request();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($event_time) = request_strings('event_time');
    $event_time = (int)$event_time;

    return [$text, $event_time];

}
