<?php

namespace SubscribedChannels;

function clearNumNotifications ($mysqli, $id) {
    $sql = 'update subscribed_channels set num_notifications = 0'
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
