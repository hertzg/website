<?php

namespace Users\Folders\Received;

function addFile ($mysqli, $id, $id_users,
    $parent_id, $name, $size) {

    include_once __DIR__.'/../../../ReceivedFolderFiles/add.php';
    \ReceivedFolderFiles\add($mysqli, $id,
        $id_users, $parent_id, $name, $size);

}
