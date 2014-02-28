<?php

namespace Channels;

function addNumNotifications ($mysqli, $id, $num_notifications) {
    $sql = 'update channels set'
        ." num_notifications = num_notifications + $num_notifications"
        ." where idchannels = $id";
    $mysqli->query($sql);
}
