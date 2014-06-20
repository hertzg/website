<?php

namespace Users\Folders\Received;

function importCopy ($mysqli, $receivedFolder, $parent_id) {

    $id_users = $receivedFolder->receiver_id_users;
    $name = $receivedFolder->name;

    include_once __DIR__.'/../../../Folders/getByName.php';
    while (\Folders\getByName($mysqli, $id_users, $parent_id, $name)) {
        if (preg_match('/_(\d+)$/', $name, $match)) {
            $name = preg_replace('/_\d+$/', '_'.($match[1] + 1), $name);
        } else {
            $name .= '_1';
        }
    }

    include_once __DIR__.'/../../../Folders/add.php';
    return \Folders\add($mysqli, $id_users, $parent_id, $name);

}
