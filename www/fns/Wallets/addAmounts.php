<?php

namespace Wallets;

function addAmounts ($mysqli, $id, $balance, $income, $expense) {
    $sql = "update wallets set balance = balance + $balance,"
        ." income = income + $income, expense = expense + $expense"
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
