<?php

function user_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/user/get_methods.php";
    $description = user\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('User', 'user', $methodName,
        $description, $params, $returns, $errors);

}
