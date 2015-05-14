<?php

namespace Wallets;

function editAmounts ($mysqli, $id, $income, $expense, $balance) {
    $sql = "update wallets set income = $income, expense = $expense,"
        ." balance = $balance where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
