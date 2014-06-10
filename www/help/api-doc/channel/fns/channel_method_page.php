<?php

function channel_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/channel/get_methods.php';
    $description = channel\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('Channel', 'channel', $methodName,
        $description, $params, $errors);

}
