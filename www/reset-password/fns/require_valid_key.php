<?php

function require_valid_key ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_guest_user.php";
    require_guest_user('../');

    include_once "$fnsDir/request_strings.php";
    list($id_users) = request_strings('id_users');

    $id_users = abs((int)$id_users);

    include_once "$fnsDir/LinkKey/request.php";
    $key = LinkKey\request();

    include_once "$fnsDir/Users/getByResetPasswordKey.php";
    $user = Users\getByResetPasswordKey($mysqli, $id_users, $key);

    return [$user, $key, $id_users];

}
