<?php

function received_contact_method_page ($methodName, $params, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/contact/received/get_methods.php";
    $description = contact\received\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('contact', 'Received', 'received',
        $methodName, $description, $params, $errors);

}
