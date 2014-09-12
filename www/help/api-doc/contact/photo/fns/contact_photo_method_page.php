<?php

function contact_photo_method_page ($methodName,
    array $params, array $errors) {

    include_once __DIR__.'/../../../fns/contact/photo/get_methods.php';
    $description = contact\photo\get_methods()[$methodName];

    include_once __DIR__.'/../../../fns/submethod_page.php';
    submethod_page('contact', 'Photo', 'photo',
        $methodName, $description, $params, $errors);

}
