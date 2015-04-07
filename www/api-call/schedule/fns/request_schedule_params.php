<?php

function request_schedule_params () {

    include_once __DIR__.'/../../../fns/Schedules/request.php';
    list($text, $interval, $tags, $offset) = Schedules\request();

    if ($text === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_TEXT');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$text, $interval, $offset, $tags, $tag_names];

}
