<?php

namespace Users\Folders\Received;

function unarchive ($mysqli, $receivedFolder) {

    if (!$receivedFolder->archived) return;

    include_once __DIR__.'/../../../ReceivedFolders/setArchived.php';
    \ReceivedFolders\setArchived($mysqli, $receivedFolder->id, false);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedFolder->receiver_id_users, 0, -1);

}
