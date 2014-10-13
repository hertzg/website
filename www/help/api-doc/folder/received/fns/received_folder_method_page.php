<?php

function received_folder_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/folder/received/get_methods.php";
    $description = folder\received\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('folder', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
