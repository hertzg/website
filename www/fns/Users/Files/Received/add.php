<?php

namespace Users\Files\Received;

function add ($mysqli, $user,
    $receiver_id_users, $name, $size, $filePath) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedFiles/add.php";
    $id = \ReceivedFiles\add($mysqli, null, $user->id_users,
        $user->username, $receiver_id_users, $name, $size);

    include_once "$fnsDir/ReceivedFiles/File/path.php";
    copy($filePath, \ReceivedFiles\File\path($receiver_id_users, $id));

    include_once "$fnsDir/ReceivedFiles/commit.php";
    \ReceivedFiles\commit($mysqli, $id);

    $sql = 'update users set num_received_files = num_received_files + 1,'
        .' home_num_new_received_files = home_num_new_received_files + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
