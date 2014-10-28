<?php

namespace Users\Files\Received;

function importCopy ($mysqli, $receivedFile, $parent_id, $insertApiKey = null) {

    $id_users = $receivedFile->receiver_id_users;
    $name = $receivedFile->name;

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    $filePath = \ReceivedFiles\File\path($id_users, $receivedFile->id);

    include_once "$fnsDir/Files/getByName.php";
    while (\Files\getByName($mysqli, $id_users, $parent_id, $name)) {
        $extension = '';
        if (preg_match('/\..*?$/', $name, $match)) {
            $name = preg_replace('/\..*?$/', '', $name);
            $extension = $match[0];
        }
        if (preg_match('/_(\d+)$/', $name, $match)) {
            $name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $name);
        } else {
            $name .= '_1';
        }
        if ($extension) {
            $name = "$name$extension";
        }
    }

    include_once "$fnsDir/Users/Files/add.php";
    return \Users\Files\add($mysqli, $id_users,
        $parent_id, $name, $filePath, $insertApiKey);

}
