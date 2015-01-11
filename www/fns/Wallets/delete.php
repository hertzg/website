<?php

namespace Wallets;

function delete ($mysqli, $id) {
    $sql = "delete from wallets where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
