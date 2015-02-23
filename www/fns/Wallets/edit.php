<?php

namespace Wallets;

function edit ($mysqli, $id, $name, $updateApiKey) {

    $name = $mysqli->real_escape_string($name);
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $escaped_name = $mysqli->real_escape_string($updateApiKey->name);
        $update_api_key_name = "'$escaped_name'";

    }

    $sql = "update wallets set name = '$name', update_time = $update_time,"
        ." update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
