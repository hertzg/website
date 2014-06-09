<?php

function contact_method_page ($methodName, $params, $errors) {

    include_once __DIR__.'/../../fns/contact/get_methods.php';
    $description = contact\get_methods()[$methodName];

    include_once '../../fns/method_page.php';
    method_page('Contact', 'contact', $methodName,
        $description, $params, $errors);

}
