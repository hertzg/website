<?php

namespace Users\ApiKeys;

function getByName ($mysqli, $user, $name, $exclude_id = null) {

    if (!$user->num_api_keys) return;

    include_once __DIR__.'/../../ApiKeys/getOnUserByName.php';
    return \ApiKeys\getOnUserByName($mysqli,
        $user->id_users, $name, $exclude_id);

}
