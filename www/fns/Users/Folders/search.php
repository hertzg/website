<?php

namespace Users\Folders;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_folders) return [];

    include_once __DIR__.'/../../Folders/search.php';
    return \Folders\search($mysqli, $user->id_users, $keyword);

}
