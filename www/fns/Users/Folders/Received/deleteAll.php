<?php

namespace Users\Folders\Received;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../../ReceivedFolders/deleteOnReceiver.php';
    \ReceivedFolders\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_folders = 0,'
        .' num_archived_received_folders = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
