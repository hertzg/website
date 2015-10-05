<?php

namespace Users\Files;

function get ($mysqli, $user, $id) {

    if (!$user->num_files) return;

    include_once __DIR__.'/../../Files/getOnUser.php';
    return \Files\getOnUser($mysqli, $user->id_users, $id);

}
