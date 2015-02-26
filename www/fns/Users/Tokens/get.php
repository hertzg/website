<?php

namespace Users\Tokens;

function get ($mysqli, $user, $id) {

    if (!$user->num_tokens) return;

    include_once __DIR__.'/../../Tokens/getOnUser.php';
    return \Tokens\getOnUser($mysqli, $user->id_users, $id);

}
