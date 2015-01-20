<?php

function require_folder ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id_folders) = request_strings('id_folders');

    $id_folders = abs((int)$id_folders);

    include_once "$fnsDir/Folders/getOnUser.php";
    $folder = Folders\getOnUser($mysqli, $user->id_users, $id_folders);

    if (!$folder) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$folder, $id_folders, $user];

}
