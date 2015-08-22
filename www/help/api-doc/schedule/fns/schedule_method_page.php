<?php

function schedule_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/schedule/get_methods.php";
    $description = schedule\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Schedule', 'schedule', $methodName,
        $description, $params, $returns, $errors);

}
