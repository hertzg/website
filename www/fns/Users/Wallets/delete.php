<?php

namespace Users\Wallets;

function delete ($mysqli, $wallet) {

    include_once __DIR__.'/../../Wallets/delete.php';
    \Wallets\delete($mysqli, $wallet->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $wallet->id_users, -1);

}
