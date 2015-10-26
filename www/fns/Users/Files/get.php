<?php

namespace Users\Files;

function get ($mysqli, $user, $id) {

    if (!$user->num_files) return;

    include_once __DIR__.'/../../Files/Committed/getOnUser.php';
    return \Files\Committed\getOnUser($mysqli, $user->id_users, $id);

}
