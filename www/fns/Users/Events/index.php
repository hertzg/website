<?php

namespace Users\Events;

function index ($mysqli, $user) {

    if (!$user->num_events) return [];

    include_once __DIR__.'/../../Events/indexOnUser.php';
    return \Events\indexOnUser($mysqli, $user->id_users);

}
