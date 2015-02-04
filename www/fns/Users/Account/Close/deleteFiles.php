<?php

namespace Users\Account\Close;

function deleteFiles ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Files/deleteOnUser.php";
    \Files\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/Files/File/deleteOnUser.php";
    \Files\File\deleteOnUser($id_users);

    if ($user->num_received_files) {

        include_once "$fnsDir/ReceivedFiles/deleteOnReceiver.php";
        \ReceivedFiles\deleteOnReceiver($mysqli, $id_users);

        include_once "$fnsDir/ReceivedFiles/File/deleteOnReceiver.php";
        \ReceivedFiles\File\deleteOnReceiver($id_users);

    }

}
