<?php

namespace Wallets;

function removeTransaction ($mysqli, $id, $amount) {
    $sql = 'update wallets set num_transactions = num_transactions - 1,'
        ." balance = balance - $amount where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
