<?php

namespace Schedules;

function request () {

    include_once __DIR__.'/requestFirstStage.php';
    list($text, $interval) = requestFirstStage();

    include_once __DIR__.'/../request_strings.php';
    list($tags, $offset) = request_strings('tags', 'offset');

    include_once __DIR__.'/../str_collapse_spaces.php';
    $tags = str_collapse_spaces($tags);

    $offset = min($interval - 1, abs((int)$offset));

    return [$text, $interval, $offset, $tags];

}
