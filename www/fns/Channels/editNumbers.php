<?php

namespace Channels;

function editNumbers ($mysqli, $id, $num_notifications, $num_users) {
    $sql = "update channels set num_notifications = $num_notifications,"
        ." num_users = $num_users where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
