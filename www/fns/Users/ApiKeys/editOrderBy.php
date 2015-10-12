<?php

namespace Users\ApiKeys;

function editOrderBy ($mysqli, $id, $api_keys_order_by) {
    $sql = "update users set api_keys_order_by = '$api_keys_order_by'"
        ." where id_users = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
