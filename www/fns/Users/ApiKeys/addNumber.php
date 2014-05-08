<?php

namespace Users\ApiKeys;

function addNumber ($mysqli, $id_users, $num_api_keys) {
    $sql = "update users set num_api_keys = num_api_keys + $num_api_keys"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
