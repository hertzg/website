<?php

namespace Tasks;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from tasks where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
