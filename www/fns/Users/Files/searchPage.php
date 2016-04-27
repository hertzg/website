<?php

namespace Users\Files;

function searchPage ($mysqli, $user, $includes,
    $excludes, $offset, $limit, &$total) {

    if (!$user->num_files) return [];

    include_once __DIR__.'/../../Files/searchPage.php';
    return \Files\searchPage($mysqli, $user->id_users,
        $includes, $excludes, $offset, $limit, $total);

}
