<?php

namespace Users\Files;

function searchInFolder ($mysqli, $user, $parent_id, $keyword) {

    if (!$user->num_files) return [];

    include_once __DIR__.'/../../Files/searchInFolder.php';
    return \Files\searchInFolder($mysqli,
        $user->id_users, $parent_id, $keyword);

}
