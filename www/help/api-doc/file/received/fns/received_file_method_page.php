<?php

function received_file_method_page ($methodName,
    array $params, array $errors) {

    include_once __DIR__.'/../../../fns/file/received/get_methods.php';
    $description = file\received\get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('file', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
