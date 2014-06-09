<?php

function received_task_method_page ($methodName,
    array $params, array $errors) {

    include_once __DIR__.'/../../../fns/task/received/get_methods.php';
    $description = task\received\get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('task', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
