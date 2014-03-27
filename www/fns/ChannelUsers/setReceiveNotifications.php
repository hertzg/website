<?php

namespace ChannelUsers;

function setReceiveNotifications ($mysqli, $id, $receive_notifications) {
    $receive_notifications = $receive_notifications ? '1' : '0';
    $sql = 'update channel_users'
        ." set receive_notifications = $receive_notifications"
        ." where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
