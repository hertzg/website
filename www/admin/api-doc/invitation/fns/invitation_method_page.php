<?php

function invitation_method_page ($methodName, $params, $returns, $errors) {

    $dir = __DIR__.'/../../fns';

    include_once "$dir/invitation/get_methods.php";
    $description = invitation\get_methods()[$methodName];

    include_once "$dir/method_page.php";
    method_page('Invitation', 'invitation', $methodName,
        $description, $params, $returns, $errors);

}
