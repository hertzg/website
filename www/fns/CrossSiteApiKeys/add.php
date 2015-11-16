<?php

namespace CrossSiteApiKeys;

function add ($mysqli, $id_users, $key) {
    $key = $mysqli->real_escape_string($key);
    $insert_time = time();
    $sql = 'insert into cross_site_api_keys (id_users, `key`, insert_time)'
        ." values ($id_users, '$key', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    return $mysqli->insert_id;
}
