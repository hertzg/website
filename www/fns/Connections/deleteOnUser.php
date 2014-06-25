<?php

namespace Connections;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from connections where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
