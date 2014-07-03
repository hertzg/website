<?php

function require_parent_folder ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('parent_id_folders');

    $id = abs((int)$id);

    if ($id) {

        include_once "$fnsDir/Folders/get.php";
        $folder = Folders\get($mysqli, $user->id_users, $id);

        if (!$folder) {
            include_once "$fnsDir/redirect.php";
            redirect('..');
        }

    } else {
        $folder = null;
    }

    return [$folder, $id, $user];

}
