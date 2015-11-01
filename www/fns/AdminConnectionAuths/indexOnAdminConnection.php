<?php

namespace AdminConnectionAuths;

function indexOnAdminConnection ($mysqli, $id, $limit) {
    $sql = 'select * from admin_connection_auths'
        ." where id_admin_connections = $id"
        ." order by insert_time desc limit $limit";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
