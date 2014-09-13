<?php

function received_bookmark_method_page ($methodName, $params, $errors) {

    $fns = __DIR__.'/../../../fns';

    include_once "$fns/bookmark/received/get_methods.php";
    $description = bookmark\received\get_methods()[$methodName];

    include_once "$fns/submethod_page.php";
    submethod_page('bookmark', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
