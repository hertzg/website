<?php

namespace Users\Wallets;

function addNumTransactions ($mysqli, $id) {
    $sql = 'update wallets set num_transactions = num_transactions + 1'
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
