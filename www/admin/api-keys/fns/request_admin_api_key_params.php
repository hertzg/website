<?php

function request_admin_api_key_params ($mysqli, &$errors, $exclude_id = 0) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/AdminApiKeys/request.php";
    list($name) = AdminApiKeys\request();

    if ($name === '') $errors[] = 'Enter name.';
    else {
        include_once "$fnsDir/AdminApiKeys/getByName.php";
        $apiKey = AdminApiKeys\getByName($mysqli, $name, $exclude_id);
        if ($apiKey) {
            $errors[] = 'An admin API key with this name already exists.';
        }
    }

    return [$name];

}
