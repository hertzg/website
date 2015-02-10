<?php

function require_place ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Places/getOnUser.php";
    $place = Places\getOnUser($mysqli, $id_users, $id);

    if (!$place) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('NOTE_NOT_FOUND');
    }

    return $place;

}
