<?php

namespace Wallets;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $wallet = get($mysqli, $id);
    if ($wallet && $wallet->id_users == $id_users) return $wallet;
}
