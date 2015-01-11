<?php

namespace Wallets;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from wallets where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
