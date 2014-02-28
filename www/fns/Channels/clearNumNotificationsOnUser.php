<?php

namespace Channels;

function clearNumNotificationsOnUser ($mysqli, $idusers) {
    $sql = 'update channels set num_notifications = 0'
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
