<?php

function notification_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/notification/get_methods.php';
    $description = notification\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('Notification', 'notification',
        $methodName, $description, $params, $errors);

}
