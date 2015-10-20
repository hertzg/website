<?php

namespace AdminApiKeyAuths;

function deleteOnAdminApiKey ($mysqli, $id_admin_api_keys) {
    $sql = 'delete from admin_api_key_auths'
        ." where id_admin_api_keys = $id_admin_api_keys";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
