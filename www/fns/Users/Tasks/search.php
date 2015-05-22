<?php

namespace Users\Tasks;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_tasks) return [];

    include_once __DIR__.'/../../Tasks/search.php';
    return \Tasks\search($mysqli, $user->id_users, $keyword);

}
