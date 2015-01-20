<?php

function require_parent_folder ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('parent_id');

    $id = abs((int)$id);

    if ($id) {

        include_once "$fnsDir/Folders/getOnUser.php";
        $folder = Folders\getOnUser($mysqli, $id_users, $id);

        if (!$folder) {
            include_once __DIR__.'/../fns/bad_request.php';
            bad_request('PARENT_FOLDER_NOT_FOUND');
        }

    } else {
        $folder = null;
    }

    return [$folder, $id];

}
