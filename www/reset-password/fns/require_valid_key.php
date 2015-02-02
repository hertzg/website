<?php

function require_valid_key ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id_users, $key) = request_strings('id_users', 'key');

    include_once "$fnsDir/is_md5.php";
    if (!is_md5($key)) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    $id_users = abs((int)$id_users);

    include_once "$fnsDir/Users/getByResetPasswordKey.php";
    $user = Users\getByResetPasswordKey($mysqli, $id_users, $key);

    return [$user, $key, $id_users];

}
