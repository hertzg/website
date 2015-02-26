<?php

namespace Users\Events;

function get ($mysqli, $user, $id) {

    if (!$user->num_events) return;

    include_once __DIR__.'/../../Events/getOnUser.php';
    return \Events\getOnUser($mysqli, $user->id_users, $id);

}
