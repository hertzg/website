<?php

function schedule_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/schedule/get_methods.php';
    $description = schedule\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('Schedule', 'schedule',
        $methodName, $description, $params, $errors);

}
