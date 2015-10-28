<?php

namespace Users\Files;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_files) return [];

    include_once __DIR__.'/../../Files/searchPage.php';
    return \Files\searchPage($mysqli, $user->id_users,
        $keyword, $offset, $limit, $total);

}
