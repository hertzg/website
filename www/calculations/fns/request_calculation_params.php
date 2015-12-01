<?php

function request_calculation_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Calculations/request.php";
    list($url, $title, $tags) = Calculations\request();

    if ($url === '') {
        $errors[] = 'Enter URL.';
        $focus = 'url';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$url, $title, $tags, $tag_names];

}
