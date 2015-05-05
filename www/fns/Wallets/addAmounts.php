<?php

namespace Wallets;

function addAmounts ($mysqli, $id, $income, $expense, $balance) {
    $sql = "update wallets set income = income + $income,"
        ." expense = expense + $expense, balance = balance + $balance"
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
