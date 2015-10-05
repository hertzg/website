<?php

namespace Users\Files;

function indexPreviewableInFolder ($mysqli, $user, $parent_id) {

    if (!$user->num_files) return [];

    include_once __DIR__.'/../../Files/indexPreviewableInUserFolder.php';
    return \Files\indexPreviewableInUserFolder(
        $mysqli, $user->id_users, $parent_id);

}
