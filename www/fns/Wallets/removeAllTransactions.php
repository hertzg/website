<?php

namespace Wallets;

function removeAllTransactions ($mysqli, $id) {
    $sql = 'update wallets set num_transactions = 0,'
        ." income = 0, expense = 0, balance = 0 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
