<?php

function require_optional_folder ($mysqli, $base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../");
    $id_users = $user->id_users;

    include_once "$fnsDir/request_strings.php";
    list($id_folders) = request_strings('id_folders');

    $id_folders = abs((int)$id_folders);

    if ($id_folders) {
        include_once "$fnsDir/Folders/getOnUser.php";
        $folder = Folders\getOnUser($mysqli, $id_users, $id_folders);
        if ($folder) {
            $id_folders = $folder->id_folders;
        } else {
            include_once "$fnsDir/redirect.php";
            redirect($base);
        }
    } else {
        $folder = null;
        $id_folders = 0;
    }

    return [$user, $folder, $id_folders];

}
