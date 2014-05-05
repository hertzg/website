<?php

namespace Users\Tokens;

function addNumber ($mysqli, $id_users, $num_tokens) {
    $sql = "update users set num_tokens = num_tokens + $num_tokens"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
