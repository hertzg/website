<?php

namespace Connections;

function deleteContainingUser ($mysqli, $id_users) {
    $sql = "delete from connections where id_users = $id_users"
        ." or connected_id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
