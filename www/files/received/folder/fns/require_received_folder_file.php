<?php

function require_received_folder_file ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedFolderFiles/getOnUser.php";
    $receivedFolderFile = ReceivedFolderFiles\getOnUser(
        $mysqli, $user->id_users, $id);

    if (!$receivedFolderFile) {
        include_once "$fnsDir/redirect.php";
        redirect("$base../..");
    }

    return [$receivedFolderFile, $id, $user];

}
