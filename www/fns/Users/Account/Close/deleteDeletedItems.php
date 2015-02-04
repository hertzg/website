<?php

namespace Users\Account\Close;

function deleteDeletedItems ($mysqli, $user) {
    if ($user->num_deleted_items) {

        $id_users = $user->id_users;
        $fnsDir = __DIR__.'/../../..';

        include_once "$fnsDir/DeletedItems/deleteOnUser.php";
        \DeletedItems\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/DeletedFiles/deleteOnUser.php";
        \DeletedFiles\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/DeletedFolders/deleteOnUser.php";
        \DeletedFolders\deleteOnUser($mysqli, $id_users);

    }
}
