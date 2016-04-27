<?php

namespace Users\Wallets;

function searchPage ($mysqli, $user,
    $includes, $excludes, $offset, $limit, &$total) {

    if (!$user->num_wallets) return [];

    include_once __DIR__.'/../../Wallets/searchPage.php';
    return \Wallets\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->wallets_order_by);

}
