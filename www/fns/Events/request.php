<?php

namespace Events;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($event_time, $text) = request_strings('event_time', 'text');

    $event_time = (int)$event_time;

    include_once "$fnsDir/str_collapse_spaces.php";
    $text = str_collapse_spaces($text);

    return [$event_time, $text];

}
