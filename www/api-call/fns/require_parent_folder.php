<?php

function require_parent_folder ($mysqli, $id_users) {

    include_once __DIR__.'/../../fns/request_strings.php';
    list($parent_id) = request_strings('parent_id');

    $parent_id = abs((int)$parent_id);

    if ($parent_id) {

        include_once __DIR__.'/../../fns/Folders/get.php';
        $folder = Folders\get($mysqli, $id_users, $parent_id);

        if (!$folder) {
            include_once __DIR__.'/../fns/bad_request.php';
            bad_request('FOLDER_NOT_FOUND');
        }

    } else {
        $folder = null;
    }

    return [$folder, $parent_id];

}
