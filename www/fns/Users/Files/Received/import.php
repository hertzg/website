<?php

namespace Users\Files\Received;

function import ($mysqli, $receivedFile, $id_folders) {

    $id_users = $receivedFile->receiver_id_users;
    $name = $receivedFile->name;

    include_once __DIR__.'/../../../ReceivedFiles/filePath.php';
    $filePath = \ReceivedFiles\filePath($id_users, $receivedFile->id);

    include_once __DIR__.'/../../../Files/getByName.php';
    while (\Files\getByName($mysqli, $id_users, $id_folders, $name)) {
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

    include_once __DIR__.'/../../../Users/Files/add.php';
    \Users\Files\add($mysqli, $id_users, $id_folders, $name, $filePath);

    include_once __DIR__.'/delete.php';
    delete($mysqli, $receivedFile);

}
