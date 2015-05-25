<?php

function request_bar_chart_params () {

    include_once __DIR__.'/../../../fns/BarCharts/request.php';
    list($name, $tags) = BarCharts\request();

    if ($name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_NAME');
    }

    include_once __DIR__.'/../../fns/require_tags.php';
    list($tags, $tag_names) = require_tags();

    return [$name, $tags, $tag_names];

}
