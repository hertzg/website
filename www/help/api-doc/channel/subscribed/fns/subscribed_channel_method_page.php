<?php

function subscribed_channel_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/channel/subscribed/get_methods.php";
    $description = channel\subscribed\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('channel', 'Subscribed', 'subscribed',
        $methodName, $description, $params, $errors);

}
