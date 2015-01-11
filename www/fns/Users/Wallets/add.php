<?php

namespace Users\Wallets;

function add ($mysqli, $id_users, $name) {

    include_once __DIR__.'/../../Wallets/add.php';
    $id = \Wallets\add($mysqli, $id_users, $name);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
