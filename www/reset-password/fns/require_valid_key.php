<?php

function require_valid_key ($mysqli) {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($idusers, $key) = request_strings('idusers', 'key');

    include_once __DIR__.'/../../fns/is_md5.php';
    if (!is_md5($key)) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    include_once __DIR__.'/../../fns/Users/getByResetPasswordKey.php';
    $user = Users\getByResetPasswordKey($mysqli, $idusers, $key);

    if (!$user) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$user, $key];

}
