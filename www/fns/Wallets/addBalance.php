<?php

namespace Wallets;

function addBalance ($mysqli, $id, $balance) {
    $sql = "update wallets set balance = balance + $balance where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
