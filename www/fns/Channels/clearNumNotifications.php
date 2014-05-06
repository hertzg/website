<?php

namespace Channels;

function clearNumNotifications ($mysqli, $id) {
    $sql = "update channels set num_notifications = 0 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli);
}
