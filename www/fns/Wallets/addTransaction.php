<?php

namespace Wallets;

function addTransaction ($mysqli, $id, $amount) {

    if ($amount > 0) {
        $income = $amount;
        $expense = 0;
    } else {
        $expense = -$amount;
        $income = 0;
    }

    $sql = 'update wallets set num_transactions = num_transactions + 1,'
        ." income = income + $income, expense = expense + $expense,"
        ." balance = balance + $amount where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
