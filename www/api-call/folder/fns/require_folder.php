<?php

function require_folder ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Folders/getOnUser.php";
    $folder = Folders\getOnUser($mysqli, $id_users, $id);

    if (!$folder) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FOLDER_NOT_FOUND');
    }

    return $folder;

}
