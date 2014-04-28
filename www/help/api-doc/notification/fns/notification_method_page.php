<?php

function notification_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/get_methods.php';
    $description = get_methods()[$methodName];

    include_once '../../fns/method_page.php';
    method_page('Notification', 'notification',
        $methodName, $description, $params, $errors);

}
