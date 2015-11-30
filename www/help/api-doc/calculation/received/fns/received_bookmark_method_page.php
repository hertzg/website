<?php

function received_calculation_method_page (
    $methodName, $params, $returns, $errors) {

    $fns = __DIR__.'/../../../fns';

    include_once "$fns/calculation/received/get_methods.php";
    $description = calculation\received\get_methods()[$methodName];

    include_once "$fns/submethod_page.php";
    submethod_page('calculation', 'Received', 'received',
        $methodName, $description, $params, $returns, $errors);

}
