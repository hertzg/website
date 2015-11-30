<?php

function require_calculation_params (&$url, &$title, &$tags, &$tag_names) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Calculations/request.php";
    list($url, $title, $tags) = Calculations\request();

    if ($url === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_URL"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
