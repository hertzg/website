<?php

function request_schedule_params () {

    include_once __DIR__.'/../../../fns/Schedules/request.php';
    list($text, $interval, $offset) = Schedules\request();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    return [$text, $interval, $offset];

}
