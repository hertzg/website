<?php

namespace Users\Places;

function index ($mysqli, $user) {

    if (!$user->num_places) return [];

    include_once __DIR__.'/../../Places/indexOnUser.php';
    return \Places\indexOnUser($mysqli, $user->id_users);

}
