<?php

function require_bar_chart_params (&$name, &$tags, &$tag_names) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/BarCharts/request.php";
    list($name, $tags) = BarCharts\request();

    if ($name === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_NAME"');
    }

    include_once "$fnsDir/ApiCall/requireTags.php";
    ApiCall\requireTags($tags, $tag_names);

}
