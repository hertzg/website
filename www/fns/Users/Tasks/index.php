<?php

namespace Users\Tasks;

function index ($mysqli, $user) {

    if (!$user->num_tasks) return [];

    include_once __DIR__.'/../../Tasks/indexOnUser.php';
    return \Tasks\indexOnUser($mysqli, $user->id_users);

}
