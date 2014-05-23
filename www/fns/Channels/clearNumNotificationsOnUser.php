<?php

namespace Channels;

function clearNumNotificationsOnUser ($mysqli, $id_users) {
    $sql = "update channels set num_notifications = 0"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
