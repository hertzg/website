<?php

namespace Users\Wallets;

function addNumber ($mysqli, $id_users, $num_wallets) {
    $sql = "update users set num_wallets = num_wallets + $num_wallets"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
