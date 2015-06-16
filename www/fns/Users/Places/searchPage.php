<?php

namespace Users\Places;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_places) return [];

    include_once __DIR__.'/../../Places/searchPage.php';
    return \Places\searchPage($mysqli,
        $user->id_users, $keyword, $offset, $limit, $total);

}
