<?php

namespace Users\Files;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_files) return [];

    include_once __DIR__.'/../../Files/search.php';
    return \Files\search($mysqli, $user->id_users, $keyword);

}
