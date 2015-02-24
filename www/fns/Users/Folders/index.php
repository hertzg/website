<?php

namespace Users\Folders;

function index ($mysqli, $user, $parent_id) {

    if (!$user->num_folders) return [];

    include_once __DIR__.'/../../Folders/indexInUserFolder.php';
    return \Folders\indexInUserFolder($mysqli, $user->id_users, $parent_id);

}
