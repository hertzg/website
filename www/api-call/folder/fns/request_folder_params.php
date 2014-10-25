<?php

function request_folder_params ($mysqli,
    $id_users, $id_folders, $exclude_id = 0) {

    include_once __DIR__.'/../../../fns/Folders/request.php';
    $name = Folders\request();

    if ($name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_NAME');
    }

    include_once __DIR__.'/../../../fns/Folders/getByName.php';
    $existingFolder = Folders\getByName($mysqli,
        $id_users, $id_folders, $name, $exclude_id);

    if ($existingFolder) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FOLDER_ALREADY_EXISTS');
    }

    return $name;

}
