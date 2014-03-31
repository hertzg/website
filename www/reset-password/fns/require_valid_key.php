<?php

function require_valid_key ($mysqli) {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id_users, $key) = request_strings('id_users', 'key');

    include_once __DIR__.'/../../fns/is_md5.php';
    if (!is_md5($key)) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    include_once __DIR__.'/../../fns/Users/getByResetPasswordKey.php';
    $user = Users\getByResetPasswordKey($mysqli, $id_users, $key);

    if (!$user) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$user, $key];

}
