<?php

namespace Channels;

function addNumNotifications ($mysqli, $id, $numnotifications) {
    $sql = 'update channels set'
        ." numnotifications = numnotifications + $numnotifications"
        ." where idchannels = $id";
    $mysqli->query($sql);
}
