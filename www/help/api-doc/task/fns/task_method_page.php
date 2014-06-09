<?php

function task_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/task/get_methods.php';
    $description = task\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('Task', 'task', $methodName, $description, $params, $errors);

}
