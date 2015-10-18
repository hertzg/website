<?php

namespace AdminApiKeyAuths;

function deleteOlder ($mysqli, $insert_time) {
    $sql = "delete from admin_api_key_auths where insert_time < $insert_time";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
