<?php

function channel_user_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/channel/user/get_methods.php";
    $description = channel\user\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('channel', 'User', 'user',
        $methodName, $description, $params, $errors);

}
