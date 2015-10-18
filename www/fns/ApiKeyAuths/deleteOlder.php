<?php

namespace ApiKeyAuths;

function deleteOlder ($mysqli, $insert_time) {
    $sql = "delete from api_key_auths where insert_time < $insert_time";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
