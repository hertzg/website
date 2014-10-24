<?php

namespace Tasks;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_text.php";
    $text = request_text('text');

    include_once "$fnsDir/request_strings.php";
    list($top_priority) = request_strings('top_priority');
    $top_priority = (bool)$top_priority;

    return [$text, $top_priority];

}
