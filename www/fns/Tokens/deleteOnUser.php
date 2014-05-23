<?php

namespace Tokens;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from tokens where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
