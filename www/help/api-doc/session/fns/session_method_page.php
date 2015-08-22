<?php

function session_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/session/get_methods.php";
    $description = session\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    include_once "$dir/true_result.php";
    method_page('Session', 'session', $methodName,
        $description, $params, true_result(), $errors);

}
