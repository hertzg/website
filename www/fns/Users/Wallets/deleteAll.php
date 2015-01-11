<?php

namespace Users\Wallets;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Wallets/deleteOnUser.php';
    \Wallets\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_wallets = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
