<?php

function request_bar_chart_params (&$errors) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/BarCharts/request.php";
    list($name, $tags) = BarCharts\request();

    if ($name === '') $errors[] = 'Enter name.';

    include_once "$fnsDir/request_tags.php";
    request_tags($tags, $tag_names, $errors);

    return [$name, $tags, $tag_names];

}
