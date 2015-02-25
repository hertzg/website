<?php

namespace Users\ApiKeys;

function get ($mysqli, $user, $id) {

    if (!$user->num_api_keys) return;

    include_once __DIR__.'/../../ApiKeys/getOnUser.php';
    return \ApiKeys\getOnUser($mysqli, $user->id_users, $id);

}
