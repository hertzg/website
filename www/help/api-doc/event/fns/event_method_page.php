<?php

function event_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/event/get_methods.php";
    $description = event\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Event', 'event', $methodName,
        $description, $params, $returns, $errors);

}
