<?php

namespace Users\Folders\Received;

function index ($mysqli, $user) {

    if (!$user->num_received_folders) return [];

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFolders/Committed/indexOnReceiver.php";
    return \ReceivedFolders\Committed\indexOnReceiver($mysqli, $user->id_users);

}
