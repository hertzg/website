<?php

namespace Users\Wallets;

function index ($mysqli, $user) {

    if (!$user->num_wallets) return [];

    include_once __DIR__.'/../../Wallets/indexOnUser.php';
    return \Wallets\indexOnUser($mysqli, $user->id_users);

}
