<?php

namespace Users\Places;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_places) return [];

    include_once __DIR__.'/../../Places/search.php';
    return \Places\search($mysqli, $user->id_users, $keyword);

}
