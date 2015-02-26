<?php

namespace Users\Tasks;

function get ($mysqli, $user, $id) {

    if (!$user->num_tasks) return;

    include_once __DIR__.'/../../Tasks/getOnUser.php';
    return \Tasks\getOnUser($mysqli, $user->id_users, $id);

}
