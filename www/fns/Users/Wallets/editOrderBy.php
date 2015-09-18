<?php

namespace Users\Wallets;

function editOrderBy ($mysqli, $id, $wallets_order_by) {
    $sql = "update users set wallets_order_by = '$wallets_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
