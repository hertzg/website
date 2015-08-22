<?php

function place_point_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/place/point/get_methods.php";
    $description = place\point\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('place', 'Point', 'point',
        $methodName, $description, $params, $returns, $errors);

}
