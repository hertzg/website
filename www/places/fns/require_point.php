<?php

function require_point ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/PlacePoints/getNotDeletedOnUser.php";
    $point = PlacePoints\getNotDeletedOnUser($mysqli, $user->id_users, $id);

    if (!$point) {
        unset($_SESSION['places/messages']);
        $_SESSION['places/errors'] = ['The place no longer exists.'];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    include_once "$fnsDir/Places/get.php";
    $place = Places\get($mysqli, $point->id_places);

    return [$point, $id, $user, $place];

}
