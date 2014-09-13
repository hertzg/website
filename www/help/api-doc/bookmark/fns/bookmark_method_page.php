<?php

function bookmark_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/bookmark/get_methods.php";
    $description = bookmark\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Bookmark', 'bookmark', $methodName,
        $description, $params, $errors);

}
