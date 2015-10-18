<?php

namespace ApiKeyAuths;

function indexOnApiKey ($mysqli, $id) {
    $sql = "select * from api_key_auths where id_api_keys = $id"
        .' order by insert_time desc';
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
