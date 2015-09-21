<?php

namespace Users\Wallets;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_wallets) return [];

    include_once __DIR__.'/../../Wallets/searchPage.php';
    return \Wallets\searchPage($mysqli, $user->id_users,
        $keyword, $offset, $limit, $total, $user->wallets_order_by);

}
