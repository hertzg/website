<?php

namespace AdminConnectionAuths;

function deleteOnAdminConnection ($mysqli, $id_admin_connections) {
    $sql = 'delete from admin_connection_auths'
        ." where id_admin_connections = $id_admin_connections";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
