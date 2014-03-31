<?php

function require_folder ($mysqli) {

    include_once __DIR__.'/../../fns/require_user.php';
    $user = require_user('../../');

    include_once __DIR__.'/../../fns/request_strings.php';
    list($id_folders) = request_strings('id_folders');

    $id_folders = abs((int)$id_folders);

    include_once __DIR__.'/../../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $user->id_users, $id_folders);

    if (!$folder) {
        include_once __DIR__.'/../../fns/redirect.php';
        redirect('..');
    }

    return [$folder, $id_folders, $user];

}
