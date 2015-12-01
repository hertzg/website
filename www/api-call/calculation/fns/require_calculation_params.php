<?php

function require_calculation_params (&$expression, &$title, &$tags, &$tag_names) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Calculations/request.php";
    list($expression, $title, $tags) = Calculations\request();

    if ($expression === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_EXPRESSION"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
