<?php

namespace Users\Folders;

function get ($mysqli, $user, $id) {

    if (!$user->num_folders) return;

    include_once __DIR__.'/../../Folders/getOnUser.php';
    return \Folders\getOnUser($mysqli, $user->id_users, $id);

}
