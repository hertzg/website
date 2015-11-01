<?php

namespace AdminConnections;

function delete ($mysqli, $id) {
    $sql = "delete from admin_connections where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
