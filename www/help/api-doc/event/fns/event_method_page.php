<?php

function event_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/event/get_methods.php';
    $description = event\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('Event', 'event', $methodName, $description, $params, $errors);

}
