<?php

namespace Users\Notes;

function index ($mysqli, $user) {

    if (!$user->num_notes) return [];

    include_once __DIR__.'/../../Notes/indexOnUser.php';
    return \Notes\indexOnUser($mysqli, $user->id_users);

}
