<?php

function require_parent_folder ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('parent_id');

    $id = abs((int)$id);

    if ($id) {

        include_once "$fnsDir/Users/Folders/get.php";
        $folder = Users\Folders\get($mysqli, $user, $id);

        if (!$folder) {
            include_once "$fnsDir/redirect.php";
            redirect('..');
        }

    } else {
        $folder = null;
    }

    return [$folder, $id, $user];

}
