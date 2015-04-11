<?php

function request_first_stage (&$errors) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Schedules/requestFirstStage.php";
    list($text, $interval) = Schedules\requestFirstStage();

    if ($text === '') $errors[] = 'Enter text.';

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors);

    return [$text, $interval, $tags, $tag_names];

}
