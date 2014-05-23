<?php

namespace Notifications;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from notifications where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
