<?php

function request_schedule_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Schedules/request.php";
    list($text, $interval, $tags, $offset) = Schedules\request();

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$text, $interval, $offset, $tags, $tag_names];

}
