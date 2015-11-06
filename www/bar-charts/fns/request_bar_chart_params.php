<?php

function request_bar_chart_params (&$errors, &$focus) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/BarCharts/request.php";
    list($name, $tags) = BarCharts\request();

    if ($name === '') {
        $errors[] = 'Enter name.';
        $focus = 'name';
    }

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors, $focus);

    return [$name, $tags, $tag_names];

}
