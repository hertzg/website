<?php

namespace Users\Notes;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_notes) return [];

    include_once __DIR__.'/../../Notes/search.php';
    return \Notes\search($mysqli, $user->id_users, $keyword);

}
