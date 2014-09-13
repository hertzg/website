<?php

function task_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/task/get_methods.php";
    $description = task\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Task', 'task', $methodName, $description, $params, $errors);

}
