<?php

function require_schedule_params (&$text,
    &$interval, &$offset, &$tags, &$tag_names) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Schedules/request.php";
    list($text, $interval, $tags, $offset) = Schedules\request();

    if ($text === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_TEXT"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
