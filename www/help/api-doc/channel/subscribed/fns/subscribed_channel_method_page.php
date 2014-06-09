<?php

function subscribed_channel_method_page ($methodName, array $params, array $errors) {

    include_once __DIR__.'/../../../fns/channel/subscribed/get_methods.php';
    $description = channel\subscribed\get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('channel', 'Subscribed', 'subscribed',
        $methodName, $description, $params, $errors);

}
