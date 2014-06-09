<?php

function folder_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/folder/get_methods.php';
    $description = folder\get_methods()[$methodName];

    include_once __DIR__.'/../../fns/method_page.php';
    method_page('Folder', 'folder', $methodName,
        $description, $params, $errors);

}
