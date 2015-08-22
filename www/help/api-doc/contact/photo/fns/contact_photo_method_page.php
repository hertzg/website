<?php

function contact_photo_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../../fns';

    include_once "$dir/contact/photo/get_methods.php";
    $description = contact\photo\get_methods()[$methodName];

    include_once "$dir/submethod_page.php";
    submethod_page('contact', 'Photo', 'photo',
        $methodName, $description, $params, $returns, $errors);

}
