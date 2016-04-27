<?php

namespace Users\Folders;

function searchPage ($mysqli, $user, $includes,
    $excludes, $offset, $limit, &$total) {

    if (!$user->num_folders) return [];

    include_once __DIR__.'/../../Folders/searchPage.php';
    return \Folders\searchPage($mysqli, $user->id_users,
        $includes, $excludes, $offset, $limit, $total);

}
