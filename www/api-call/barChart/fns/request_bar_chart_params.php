<?php

function request_bar_chart_params () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/BarCharts/request.php";
    list($name, $tags) = BarCharts\request();

    if ($name === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_NAME"');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$name, $tags, $tag_names];

}
