<?php

namespace Users\Folders;

function add ($mysqli, $id_users,
    $parent_id_folders, $name, $insertApiKey = null) {

    include_once __DIR__.'/../../Folders/add.php';
    $id = \Folders\add($mysqli, $id_users,
        $parent_id_folders, $name, $insertApiKey);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
