<?php

function received_file_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/file/received/get_methods.php";
    $description = file\received\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('file', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
