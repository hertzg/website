<?php

function request_first_stage (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Schedules/requestFirstStage.php";
    list($text, $interval) = Schedules\requestFirstStage();

    if ($text === '') {
        $errors[] = 'Enter text.';
        $focus = 'text';
    }

    include_once __DIR__.'/../../fns/request_tags.php';
    request_tags($tags, $tag_names, $errors, $focus);

    return [$text, $interval, $tags, $tag_names];

}
