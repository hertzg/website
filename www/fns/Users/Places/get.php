<?php

namespace Users\Places;

function get ($mysqli, $user, $id) {

    if (!$user->num_places) return;

    include_once __DIR__.'/../../Places/getOnUser.php';
    return \Places\getOnUser($mysqli, $user->id_users, $id);

}
