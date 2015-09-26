<?php

namespace AdminApiKeys;

function delete ($mysqli, $id) {
    $sql = "delete from admin_api_keys where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
