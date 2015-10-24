<?php

namespace Users\Files\Received;

function add ($mysqli, $user,
    $receiver_id_users, $name, $size, $filePath) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFiles/add.php";
    $id = \ReceivedFiles\add($mysqli, $user->id_users,
        $user->username, $receiver_id_users, $name, $size);

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    copy($filePath, \ReceivedFiles\File\path($receiver_id_users, $id));

    include_once "$fnsDir/ReceivedFiles/commit.php";
    \ReceivedFiles\commit($mysqli, $id);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
