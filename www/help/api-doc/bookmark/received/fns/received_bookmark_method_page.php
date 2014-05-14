<?php

function received_bookmark_method_page ($methodName, array $params, array $errors) {

    include_once __DIR__.'/get_methods.php';
    $description = get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('bookmark', 'Received', 'received', $methodName, $description, $params, $errors);

}
