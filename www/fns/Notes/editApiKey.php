<?php

namespace Notes;

function editApiKey ($mysqli, $api_key_id, $api_key_name) {

    $api_key_name = $mysqli->real_escape_string($api_key_name);

    $sql = "update notes set insert_api_key_name = '$api_key_name'"
        ." where insert_api_key_id = $api_key_id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    $sql = "update notes set update_api_key_name = '$api_key_name'"
        ." where update_api_key_id = $api_key_id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
