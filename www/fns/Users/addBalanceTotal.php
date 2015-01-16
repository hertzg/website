<?php

namespace Users;

function addBalanceTotal ($mysqli, $id, $balance_total) {
    $sql = "update users set balance_total = balance_total + $balance_total"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
