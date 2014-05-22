<?php

function request_file_params ($mysqli,
    $id_users, $id_folders, $exclude_id = 0) {

    include_once __DIR__.'/../../../fns/Files/request.php';
    $name = Files\request();

    if ($name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_NAME');
    }

    include_once __DIR__.'/../../../fns/Files/getByName.php';
    $existingFile = Files\getByName($mysqli, $id_users,
        $id_folders, $name, $exclude_id);

    if ($existingFile) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('FILE_ALREADY_EXISTS');
    }

    return $name;

}
