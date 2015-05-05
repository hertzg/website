<?php

namespace Wallets;

function addDeleted ($mysqli, $id, $id_users, $name, $income, $expense,
    $balance, $num_transactions, $insert_time, $update_time, $revision) {

    $name = $mysqli->real_escape_string($name);

    $sql = 'insert into wallets (id, id_users, name, income, expense,'
        .' balance, num_transactions, insert_time, update_time)'
        ." values ($id, $id_users, '$name', $income, $expense,"
        ." $balance, $num_transactions, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
