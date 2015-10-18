<?php

namespace AdminApiKeyAuths;

function indexOnAdminApiKey ($mysqli, $id) {
    $sql = "select * from admin_api_key_auths where id_admin_api_keys = $id"
        .' order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
