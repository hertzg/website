<?php

function received_schedule_method_page (
    $methodName, $params, $returns, $errors) {

    $fns = __DIR__.'/../../../fns';

    include_once "$fns/schedule/received/get_methods.php";
    $description = schedule\received\get_methods()[$methodName];

    include_once "$fns/submethod_page.php";
    submethod_page('schedule', 'Received', 'received',
        $methodName, $description, $params, $returns, $errors);

}
