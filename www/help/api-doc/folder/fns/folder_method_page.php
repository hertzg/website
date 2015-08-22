<?php

function folder_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/folder/get_methods.php";
    $description = folder\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Folder', 'folder', $methodName,
        $description, $params, $returns, $errors);

}
