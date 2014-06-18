<?php

namespace Users\Folders;

function send ($mysqli, $user, $receiver_id_users, $folder) {

    include_once __DIR__.'/../../ReceivedFolders/add.php';
    \ReceivedFolders\add($mysqli, $user->id_users, $user->username,
        $receiver_id_users, $folder->name);

    include_once __DIR__.'/Received/addNumber.php';
    \Users\Folders\Received\addNumber($mysqli, $user->id_users, 1);

}
