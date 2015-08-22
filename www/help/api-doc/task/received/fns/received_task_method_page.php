<?php

function received_task_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/task/received/get_methods.php";
    $description = task\received\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('task', 'Received', 'received',
        $methodName, $description, $params, $returns, $errors);

}
