<?php

namespace Users\Files\Received;

function importCopy ($mysqli, $receivedFile, $parent_id, $insertApiKey = null) {

    $id_users = $receivedFile->receiver_id_users;
    $name = $receivedFile->name;

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    $filePath = \ReceivedFiles\File\path($id_users, $receivedFile->id);

    include_once "$fnsDir/Files/getUniqueName.php";
    $name = \Files\getUniqueName($mysqli, $id_users, $parent_id, $name);

    include_once "$fnsDir/Users/Files/add.php";
    return \Users\Files\add($mysqli, $id_users,
        $parent_id, $name, $filePath, $insertApiKey);

}
