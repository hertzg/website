<?php

function place_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/place/get_methods.php";
    $description = place\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Place', 'place', $methodName, $description, $params, $errors);

}
