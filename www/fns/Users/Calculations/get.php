<?php

namespace Users\Calculations;

function get ($mysqli, $user, $id) {

    if (!$user->num_calculations) return;

    include_once __DIR__.'/../../Calculations/getOnUser.php';
    return \Calculations\getOnUser($mysqli, $user->id_users, $id);

}
