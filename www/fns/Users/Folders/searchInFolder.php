<?php

namespace Users\Folders;

function searchInFolder ($mysqli, $user, $parent_id, $keyword) {

    if (!$user->num_folders) return [];

    include_once __DIR__.'/../../Folders/searchInFolder.php';
    return \Folders\searchInFolder($mysqli,
        $user->id_users, $parent_id, $keyword);

}
