<?php

namespace Users\Wallets;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_wallets) return [];

    include_once __DIR__.'/../../Wallets/search.php';
    return \Wallets\search($mysqli, $user->id_users, $keyword);

}
