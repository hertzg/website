<?php

function require_place ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Places/get.php";
    $place = Users\Places\get($mysqli, $user, $id);

    if (!$place) {
        unset($_SESSION['places/messages']);
        $_SESSION['places/errors'] = ['The place no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$place, $id, $user];

}
