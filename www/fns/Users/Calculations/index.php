<?php

namespace Users\Calculations;

function index ($mysqli, $user) {

    if (!$user->num_calculations) return [];

    include_once __DIR__.'/../../Calculations/indexOnUser.php';
    return \Calculations\indexOnUser($mysqli, $user->id_users);

}
