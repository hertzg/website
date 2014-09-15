<?php

namespace Users\Folders\Received;

function archive ($mysqli, $receivedFolder) {

    if ($receivedFolder->archived) return;

    include_once __DIR__.'/../../../ReceivedFolders/setArchived.php';
    \ReceivedFolders\setArchived($mysqli, $receivedFolder->id, true);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedFolder->receiver_id_users, 1);

}
