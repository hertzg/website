<?php

namespace Users\Wallets;

function get ($mysqli, $user, $id) {

    if (!$user->num_wallets) return;

    include_once __DIR__.'/../../Wallets/getOnUser.php';
    return \Wallets\getOnUser($mysqli, $user->id_users, $id);

}
