<?php

function require_user ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/require_admin.php';
    require_admin();

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/get.php";
    $user = Users\get($mysqli, $id);

    if (!$user) {
        $_SESSION['admin/users/errors'] = ['The user no longer exists.'];
        unset($_SESSION['admin/users/messages']);
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$user, $id];

}
