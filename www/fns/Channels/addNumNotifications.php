<?php

namespace Channels;

function addNumNotifications ($mysqli, $id, $numnotifications) {
    mysqli_query(
        $mysqli,
        'update channels set'
        ." numnotifications = numnotifications + $numnotifications"
        ." where idchannels = $id"
    );
}
