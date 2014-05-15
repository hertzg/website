<?php

function received_contact_method_page ($methodName,
    array $params, array $errors) {

    include_once __DIR__.'/get_methods.php';
    $description = get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('contact', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
