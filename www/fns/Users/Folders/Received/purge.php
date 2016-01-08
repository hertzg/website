<?php

namespace Users\Folders\Received;

function purge ($mysqli, $receivedFolder) {

    include_once __DIR__.'/../../../ReceivedFolders/delete.php';
    \ReceivedFolders\delete($mysqli, $receivedFolder->id);

    $id_users = $receivedFolder->receiver_id_users;

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $id_users, -1, $receivedFolder->archived ? -1 : 0);

}
