<?php

function contact_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/contact/get_methods.php";
    $description = contact\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Contact', 'contact', $methodName,
        $description, $params, $errors);

}
