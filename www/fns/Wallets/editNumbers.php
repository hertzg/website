<?php

namespace Wallets;

function editNumbers ($mysqli, $id, $num_transactions) {
    $sql = 'update wallets set'
        ." num_transactions = $num_transactions where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
