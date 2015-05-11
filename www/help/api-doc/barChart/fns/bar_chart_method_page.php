<?php

function bar_chart_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/barChart/get_methods.php";
    $description = barChart\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Bar Chart', 'barChart', $methodName,
        $description, $params, $errors);

}
