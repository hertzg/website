<?php

namespace Users\Notes;

function get ($mysqli, $user, $id) {

    if (!$user->num_notes) return;

    include_once __DIR__.'/../../Notes/getOnUser.php';
    return \Notes\getOnUser($mysqli, $user->id_users, $id);

}
