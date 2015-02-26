<?php

function require_parent_folder ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('parent_id');

    $id = abs((int)$id);

    if ($id) {

        include_once "$fnsDir/Users/Folders/get.php";
        $folder = Users\Folders\get($mysqli, $user, $id);

        if (!$folder) {
            include_once __DIR__.'/../fns/bad_request.php';
            bad_request('PARENT_FOLDER_NOT_FOUND');
        }

    } else {
        $folder = null;
    }

    return [$folder, $id];

}
