<?php

function received_place_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/place/received/get_methods.php";
    $description = place\received\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('place', 'Received', 'received',
        $methodName, $description, $params, $returns, $errors);

}
