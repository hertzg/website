<?php

function require_file ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Files/get.php";
    $file = Files\get($mysqli, $user->id_users, $id);

    if (!$file) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$file, $id, $user];

}
