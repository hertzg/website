<?php

function file_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/file/get_methods.php';
    $description = file\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('File', 'file', $methodName, $description, $params, $errors);

}
