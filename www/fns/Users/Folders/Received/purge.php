<?php

namespace Users\Folders\Received;

function purge ($mysqli, $receivedFolder) {

    include_once __DIR__.'/../../../ReceivedFolders/delete.php';
    \ReceivedFolders\delete($mysqli, $receivedFolder->id);

    $id_users = $receivedFolder->receiver_id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    if ($receivedFolder->archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $id_users, -1);
    }

}
