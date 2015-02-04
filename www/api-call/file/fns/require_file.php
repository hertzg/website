<?php

function require_file ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Files/getOnUser.php";
    $file = Files\getOnUser($mysqli, $id_users, $id);

    if (!$file) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FILE_NOT_FOUND');
    }

    return $file;

}
