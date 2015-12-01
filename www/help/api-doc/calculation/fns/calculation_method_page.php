<?php

function calculation_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/calculation/get_methods.php";
    $description = calculation\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Calculation', 'calculation', $methodName,
        $description, $params, $returns, $errors);

}
