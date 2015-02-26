<?php

namespace Users\Folders\Received;

function get ($mysqli, $user, $id) {

    if (!$user->num_received_folders) return;

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolders/Committed/getOnReceiver.php";
    return \ReceivedFolders\Committed\getOnReceiver(
        $mysqli, $user->id_users, $id);

}
