<?php

function file_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/file/get_methods.php";
    $description = file\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('File', 'file', $methodName,
        $description, $params, $returns, $errors);

}
