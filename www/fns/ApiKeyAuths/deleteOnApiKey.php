<?php

namespace ApiKeyAuths;

function deleteOnApiKey ($mysqli, $id_api_keys) {
    $sql = "delete from api_key_auths where id_api_keys = $id_api_keys";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
