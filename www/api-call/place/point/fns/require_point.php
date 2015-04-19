<?php

function require_point ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/PlacePoints/getNotDeletedOnUser.php";
    $point = PlacePoints\getNotDeletedOnUser($mysqli, $id_users, $id);

    if (!$point) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('POINT_NOT_FOUND');
    }

    return $point;

}
