<?php

namespace Channels;

function setReceiveNotifications ($mysqli, $id, $receive_notifications) {
    $receive_notifications = $receive_notifications ? '1' : '0';
    $sql = 'update channels'
        ." set receive_notifications = $receive_notifications where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
