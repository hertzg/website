<?php

function request_admin_api_key_params (&$errors) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/AdminApiKeys/request.php";
    list($name) = AdminApiKeys\request();

    if ($name === '') $errors[] = 'Enter name.';

    return [$name];

}
