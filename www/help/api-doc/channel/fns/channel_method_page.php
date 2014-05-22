<?php

function channel_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/get_methods.php';
    $description = get_methods()[$methodName];

    include_once '../../fns/method_page.php';
    method_page('Channel', 'channel', $methodName,
        $description, $params, $errors);

}
