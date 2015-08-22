<?php

function notification_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/notification/get_methods.php";
    $description = notification\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Notification', 'notification',
        $methodName, $description, $params, $returns, $errors);

}
