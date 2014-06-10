<?php

function require_file ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Files/get.php";
    $file = Files\get($mysqli, $user->id_users, $id);

    if (!$file) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$file, $id, $user];

}
