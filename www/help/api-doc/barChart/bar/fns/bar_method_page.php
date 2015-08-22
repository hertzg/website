<?php

function bar_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/barChart/bar/get_methods.php";
    $description = barChart\bar\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('barChart', 'Bar', 'bar',
        $methodName, $description, $params, $returns, $errors);

}
