<?php

namespace Users\Files;

function index ($mysqli, $user, $parent_id) {

    if (!$user->num_files) return [];

    include_once __DIR__.'/../../Files/Committed/indexInUserFolder.php';
    return \Files\Committed\indexInUserFolder(
        $mysqli, $user->id_users, $parent_id);

}
