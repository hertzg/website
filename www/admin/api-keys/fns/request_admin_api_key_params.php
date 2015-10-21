<?php

function request_admin_api_key_params ($mysqli, &$errors, $exclude_id = 0) {

    $parseAccess = function (&$access) {
        if ($access != 'readonly' && $access != 'readwrite') $access = 'none';
    };

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/AdminApiKeys/request.php";
    list($name) = AdminApiKeys\request();

    include_once "$fnsDir/request_strings.php";
    list($expires, $invitation_access, $user_access) = request_strings(
        'expires', 'invitation_access', 'user_access');

    include_once "$fnsDir/parse_expire_time.php";
    parse_expire_time($expires, $expire_time);

    $parseAccess($invitation_access);
    $parseAccess($user_access);

    if ($name === '') $errors[] = 'Enter name.';
    else {
        include_once "$fnsDir/AdminApiKeys/getByName.php";
        $apiKey = AdminApiKeys\getByName($mysqli, $name, $exclude_id);
        if ($apiKey) {
            $errors[] = 'An admin API key with this name already exists.';
        }
    }

    return [$name, $expires, $expire_time, $invitation_access, $user_access];

}
