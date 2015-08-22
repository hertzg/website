<?php

function channel_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/channel/get_methods.php";
    $description = channel\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Channel', 'channel', $methodName,
        $description, $params, $returns, $errors);

}
