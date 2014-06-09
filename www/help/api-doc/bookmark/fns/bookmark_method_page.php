<?php

function bookmark_method_page ($methodName, array $params, array $errors) {

    include_once __DIR__.'/../../fns/bookmark/get_methods.php';
    $description = bookmark\get_methods()[$methodName];

    include_once '../../fns/method_page.php';
    method_page('Bookmark', 'bookmark', $methodName,
        $description, $params, $errors);

}
